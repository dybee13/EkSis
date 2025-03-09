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
                     ->orderBy('created_at', 'desc')
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
        $request->validate([
            'judul' => 'required|string|max:255',
            'body' => 'required|string',
            'keterangan' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg',
        ]);

        $user = Auth::user();
        $idEkskul = $user->ekskulUsers()->first()->id_ekskul ?? null;

        if (!$idEkskul) {
            return back()->with('error', 'Anda tidak memiliki ekskul yang terdaftar.');
        }

        // Buat slug dari judul blog
        $titleSlug = Str::slug($request->judul);
        // Cek apakah ID ekskul ditemukan
        // dd($request->all(), $idEkskul, $titleSlug, $request->file('images'));

        try {
            // Simpan blog ke database
            $create = new Blogs();
            $create->title = $request->judul;
            $create->slug = $titleSlug;
            $create->body = $request->body;
            $create->keterangan = $request->keterangan;
            $create->id_ekskul = $idEkskul;
            $create->save();

            Log::info("Blog berhasil disimpan dengan ID: " . $create->id);

           // Simpan gambar jika ada
            Log::info("Apakah request memiliki file gambar? " . ($request->hasFile('images') ? 'Ya' : 'Tidak'));

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    Log::info("Menyimpan gambar ke storage...");
                    $extension = $image->getClientOriginalExtension();
                    $fileName = $titleSlug . '-' . ($index + 1) . '.' . $extension;

                    // Simpan file ke storage/app/public/blogs/
                    $imagePath = $image->storeAs('public/blogs', $fileName);

                    // Tentukan apakah ini thumbnail (hanya gambar pertama)
                    $isThumbnail = $index === 0;

                    // Simpan informasi gambar ke database
                    BlogImages::create([
                        'blog_id' => $create->id,
                        'image_path' => $fileName,
                        'is_thumbnail' => $isThumbnail
                    ]);

                    Log::info("Gambar berhasil disimpan: " . $fileName);
                }
            } else {
                Log::warning("Tidak ada gambar yang diterima dari request.");
            }

            return back()->with('success', 'Blog berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error("Error saat menyimpan blog: " . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan blog.');
        }
    }
}
