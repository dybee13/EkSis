<?php

namespace App\Http\Controllers;

use App\Models\BlogImages;
use App\Models\Blogs;
use App\Models\User;
use App\Models\EkskulUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; // Tambahkan ini di atas

class pengurusController extends Controller
{
    // Dashboard Pengurus 
    public function getDashboardPengurus()
    {
        return view('pengurus.pengurusDashboard', ['title' => 'Dashboard Pengurus']);
    }

    public function Blogs()
    {
        // Ambil id_ekskul dari user yang login melalui tabel ekskul_users
        $user = Auth::user();
        $userEkskulIds = $user->ekskulUsers()->pluck('id_ekskul');

        // Ambil blogs yang memiliki id_ekskul yang sesuai dengan user
        $blogs = Blogs::with('blogImages')
                     ->whereIn('id_ekskul', $userEkskulIds)
                     ->get();

        return view('pengurus.dataBlogs', [
            'blogs' => $blogs,
            'title' => 'Data Blogs'
        ]);
    }

    public function store(Request $request)
{
    // Validasi data
    // $request->validate([
    //     'judul' => 'required|string|max:255',
    //     'body' => 'required|string',
    //     'keterangan' => 'required|string',
    //     'images.*' => 'image|mimes:jpeg,png,jpg',
    // ]);

    $user = Auth::user();
    $idEkskul = $user->ekskulUsers()->first()->id_ekskul ?? null;

    if (!$idEkskul) {
        return back()->with('error', 'Anda tidak memiliki ekskul yang terdaftar.');
    }

    // Cek apakah ID ekskul ditemukan
    // dd($request->all(), $idEkskul);

    // Buat slug dari judul blog
    $titleSlug = Str::slug($request->judul);

    try {
        // Simpan blog ke database
        $create = new Blogs();
        $create->title = $request->judul;
        $create->slug = $titleSlug;
        $create->body = $request->body;
        $create->keterangan = $request->keterangan;
        $create->save();

        Log::info("Blog berhasil disimpan dengan ID: " . $blog->id);

        // Simpan gambar jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                // Buat nama file berdasarkan judul blog + index + ekstensi
                $extension = $image->getClientOriginalExtension();
                $fileName = $titleSlug . '-' . ($index + 1) . '.' . $extension;

                // Simpan file ke storage/app/public/blogs/
                $imagePath = $image->storeAs('public/blogs', $fileName);

                // Simpan informasi gambar ke database
                $images = new BlogImages();
                $images->blog_id = $create->id;
                $images->image_path = $imagePath;
                $images->save();

                Log::info("Gambar berhasil disimpan: " . $fileName);
            }
        }

        return back()->with('success', 'Blog berhasil ditambahkan.');
    } catch (\Exception $e) {
        Log::error("Error saat menyimpan blog: " . $e->getMessage());
        return back()->with('error', 'Terjadi kesalahan saat menyimpan blog.');
    }
}
}
