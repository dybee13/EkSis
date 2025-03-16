<?php

namespace App\Http\Controllers;

use App\Models\AbsenEkskul;
use App\Models\BlogImages;
use App\Models\Blogs;
use App\Models\JadwalEkskul;
use App\Models\AnggotaEkskul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; // Tambahkan ini di atas
use Illuminate\Support\Facades\Storage;

class pengurusController extends Controller
{
    // Dashboard Pengurus 
    public function getDashboardPengurus()
    {
        $pengurus = Auth::user();
        $idEkskul = $pengurus->ekskulUsers()->first()->id_ekskul ?? null;

        // Ambil hari ini dalam format Indonesia
        $hariIni = strtolower(now()->format('l'));
        $hariIniIndo = [
            'monday' => 'senin',
            'tuesday' => 'selasa',
            'wednesday' => 'rabu',
            'thursday' => 'kamis',
            'friday' => 'jumat',
            'saturday' => 'sabtu',
            'sunday' => 'minggu',
        ];

        $hariIni = $hariIniIndo[$hariIni] ?? '';

        // Cek apakah hari ini ada latihan ekskul
        $adaLatihan = JadwalEkskul::where('id_ekskul', $idEkskul)
            ->where('hari', $hariIni)
            ->exists();

        return view('pengurus.pengurusDashboard', ['title' => 'Dashboard Pengurus', 'adaLatihan' => $adaLatihan]);
    }

    public function Blogs()
    {
        // Ambil id_ekskul dari user yang login melalui tabel ekskul_users
        $user = Auth::user();
        $userEkskulIds = $user->ekskulUsers()->pluck('id_ekskul');

        $idEkskul = $user->ekskulUsers()->first()->id_ekskul ?? null;

        // Ambil hari ini dalam format Indonesia
        $hariIni = strtolower(now()->format('l'));
        $hariIniIndo = [
            'monday' => 'senin',
            'tuesday' => 'selasa',
            'wednesday' => 'rabu',
            'thursday' => 'kamis',
            'friday' => 'jumat',
            'saturday' => 'sabtu',
            'sunday' => 'minggu',
        ];

        $hariIni = $hariIniIndo[$hariIni] ?? '';

        // Cek apakah hari ini ada latihan ekskul
        $adaLatihan = JadwalEkskul::where('id_ekskul', $idEkskul)
            ->where('hari', $hariIni)
            ->exists();

        // Ambil blogs yang memiliki id_ekskul yang sesuai dengan user
        $blogs = Blogs::with('blogImages')
                     ->orderBy('created_at', 'desc')
                     ->whereIn('id_ekskul', $userEkskulIds)
                     ->get();

        return view('pengurus.dataBlogs', [
            'blogs' => $blogs,
            'adaLatihan' => $adaLatihan,
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
            $create->is_banned = false;
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

    public function destroy($id)
    {
        // Cari blog berdasarkan ID
        $blog = Blogs::findOrFail($id);

        // Hapus semua gambar terkait di storage dan database
        foreach ($blog->blogImages as $image) {
            Storage::delete('public/blogs/' . $image->image_path);
            $image->delete();
        }

        // Hapus blog dari database
        $blog->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('blogs.data')->with('success', 'Blog berhasil dihapus.');
    }

    // Tampilkan halaman rekap absen
    public function rekapAbsen(Request $request)
    {
        $pengurus = Auth::user();
        $idEkskul = $pengurus->ekskulUsers()->pluck('id_ekskul');

        // Ambil hari ini dalam format Indonesia
        $hariIni = strtolower(now()->format('l'));
        $hariIniIndo = [
            'monday' => 'senin',
            'tuesday' => 'selasa',
            'wednesday' => 'rabu',
            'thursday' => 'kamis',
            'friday' => 'jumat',
            'saturday' => 'sabtu',
            'sunday' => 'minggu',
        ];
 
        $hariIni = $hariIniIndo[$hariIni] ?? '';
 
        // Cek apakah hari ini ada latihan ekskul
        $adaLatihan = JadwalEkskul::where('id_ekskul', $idEkskul)
             ->where('hari', $hariIni)
             ->exists();

        // Ambil status dari filter
        $statusFilter = $request->input('status');

        // Ambil data absen, dikelompokkan berdasarkan tanggal
        $rekapAbsen = AbsenEkskul::whereIn('id_ekskul', $idEkskul)
            ->when($statusFilter, function ($query, $statusFilter) {
                return $query->where('status', $statusFilter);
            })
            ->with('anggota', 'ekskul')
            ->orderBy('tanggal', 'desc')
            ->get()
            ->groupBy('tanggal'); // Kelompokkan berdasarkan tanggal

        $title = 'Rekap Absen';

        return view('pengurus.rekapAbsen', compact('rekapAbsen', 'title', 'adaLatihan', 'statusFilter'));
    }

    public function absenAnggota(Request $request)
    {
        $pengurus = Auth::user();
        $idEkskul = $pengurus->ekskulUsers()->first()->id_ekskul ?? null;

        // Ambil hari ini dalam format Indonesia
        $hariIni = strtolower(now()->format('l'));
        $hariIniIndo = [
            'monday' => 'senin',
            'tuesday' => 'selasa',
            'wednesday' => 'rabu',
            'thursday' => 'kamis',
            'friday' => 'jumat',
            'saturday' => 'sabtu',
            'sunday' => 'minggu',
        ];

        $hariIni = $hariIniIndo[$hariIni] ?? '';

        // Cek apakah hari ini ada latihan ekskul
        $adaLatihan = JadwalEkskul::where('id_ekskul', $idEkskul)
            ->where('hari', $hariIni)
            ->exists();

        // Ambil anggota ekskul berdasarkan ekskul yang dia miliki
        $anggotaEkskul = AnggotaEkskul::where('id_ekskul', $idEkskul)
                        ->orderBy('name', 'asc')->get();

        $title = 'Absen Anggota';

        return view('pengurus/absenAnggota', compact('anggotaEkskul', 'title', 'idEkskul', 'adaLatihan'));
    }

    public function submitAbsen(Request $request, $idEkskul)
    {
        $request->validate([
            'hadir' => 'array',
            'izin' => 'array',
            'sakit' => 'array',
        ]);

        $anggotaIds = AnggotaEkskul::where('id_ekskul', $idEkskul)->pluck('id')->toArray();

        foreach ($anggotaIds as $idAnggota) {
            $status = 'alpha'; // Default jika tidak dipilih

            if ($request->has("hadir.$idAnggota")) {
                $status = 'hadir';
            } elseif ($request->has("izin.$idAnggota")) {
                $status = 'izin';
            } elseif ($request->has("sakit.$idAnggota")) {
                $status = 'sakit';
            } else {
                $status = 'alpha';
            }

            AbsenEkskul::create([
                'id_anggota' => $idAnggota,
                'id_ekskul' => $idEkskul,
                'status' => $status,
                'tanggal' => now()->toDateString(),
            ]);
        }

        return redirect()->route('pengurus.absenAnggota', $idEkskul)->with('success', 'Absen berhasil disimpan.');
    }
}
