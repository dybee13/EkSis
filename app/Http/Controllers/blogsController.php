<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Ekskuls;
use App\Models\User;
use Illuminate\Http\Request;

class blogsController extends Controller
{
    public function Blogs()
    {
        $blogs = Blogs::with('blogImages')
                ->where('is_banned', false)
                ->latest() // Mengurutkan dari yang terbaru
                ->limit(6) // Hanya ambil 6 data
                ->get();

        $blogsachi = Blogs::with('blogImages', 'ekskul')
                ->where('keterangan', 'achievments')
                ->where('is_banned', false)
                ->latest() // Mengurutkan dari yang terbaru
                ->limit(3) // Hanya ambil 6 data
                ->get();

        $ekskuls = Ekskuls::with('informasiEkskul')
                ->get();
        // dd($ekskuls->toArray());

        return view('users.mainEkskul', compact('blogs', 'blogsachi', 'ekskuls'));
    }

    public function AllBlogs()
    {
        $blogs = Blogs::with('blogImages', 'ekskul')
                ->where('is_banned', false)
                ->orderBy('created_at', 'desc')
                ->get();

        return view('users.semuaBerita', compact('blogs'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Ambil blog berdasarkan judul atau nama ekskul
        $blogs = Blogs::with('blogImages', 'ekskul')
                    ->where('title', 'LIKE', "%{$query}%")
                    ->orWhereHas('ekskul', function ($q) use ($query) {
                        $q->where('nama_ekskul', 'LIKE', "%{$query}%");
                    })
                    ->where('is_banned', false)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return response()->json($blogs);
    }

    public function ekskuls() 
    {
        $ekskuls = Ekskuls::with('informasiEkskul')
                  ->get();

        // dd($ekskuls->toArray());

        return view('users.listEkskul', compact('ekskuls'));
    }

    public function EkskulBlogs($id) 
    {
        $ekskul = Ekskuls::with('strukturEkskul', 'informasiEkskul')->findOrFail($id);

        // Ambil nama pembina yang berelasi dengan ekskul melalui ekskul_users
        $pembina = User::whereHas('ekskulUsers', function ($query) use ($id) {
            $query->where('id_ekskul', $id);
        })->where('role', 'pembina')->get(['name']);
        
        $announcements = Blogs::with('blogImages')
                 ->where('id_ekskul', $id)
                 ->where('keterangan', 'announcements')
                 ->where('is_banned', false)
                 ->orderBy('created_at', 'desc')
                 ->get();

        $achievments = Blogs::with('blogImages')
                 ->where('id_ekskul', $id)
                 ->where('keterangan', 'achievments')
                 ->where('is_banned', false)
                 ->orderBy('created_at', 'desc')
                 ->get();

        $activities = Blogs::with('blogImages')
                 ->where('id_ekskul', $id)
                 ->where('keterangan', 'activities')
                 ->where('is_banned', false)
                 ->orderBy('created_at', 'desc')
                 ->get();
        // dd($ekskul->toArray(), $announcements->toArray());

        $title = 'Blogs Ekskul';

        return view('users.dataEkskul',compact(
            'ekskul',
             'announcements',
             'achievments',
             'activities',
             'pembina',
             'title'
            ));
    }

    public function detailBlog($id)
    {
        $detailBlog = Blogs::with('blogImages', 'ekskul')
                      ->findOrFail($id);

        $blogs = Blogs::with('blogImages')
                      ->whereIn('keterangan', ['achievements', 'activities']) // Filter hanya untuk 'achievements' dan 'activities'
                      ->where('id', '!=', $id) // Mengecualikan blog yang sedang dikunjungi
                      ->where('is_banned', false)
                      ->latest() // Mengurutkan dari yang terbaru
                      ->limit(4) // Hanya mengambil 3 data
                      ->get();    
    
        // dd($detailBlog->toArray());
        // dd($detailBlog->blogImages);

        return view('users.mainBlog', compact('detailBlog', 'blogs'));
    }
}
