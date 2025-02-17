<?php

namespace App\Http\Controllers;

use App\Models\AnggotaEkskul;
use App\Models\Ekskuls;
use App\Models\User;
use App\Models\EkskulUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class pembinaController extends Controller
{
    // Dashboard Pembina 
    public function getDashboardPembina()
    {
        return view('pembina.pembinaDashboard', ['title' => 'Dashboard Pembina']);
    }

    public function getJurusan()
    {
        $jurusan = [
            'RPL' => 'Rekayasa Perangkat Lunak',
            'TKJ' => 'Teknik Komputer dan Jaringan',
            'TKR' => 'Teknik Kendaraan Ringan',
            'TPM' => 'Teknik Permesinan',
            'TOI' => 'Teknik Otomasi Industri',
            'TITL' => 'Teknik Instalasi Tenaga Listrik'
        ];

        return response()->json($jurusan);
    }
    
    // Data Anggota Eskul START
    // Get Data Anggota
    public function getDataAnggotaEskul()
    {
        // Ambil ID pembina yang sedang login
        $pembina = Auth::user();

        // Ambil ekskul yang dimiliki oleh pembina
        $ekskuls = $pembina->ekskuls;

        // Ambil semua anggota yang didaftarkan oleh pembina
        $anggotaEkskul = AnggotaEkskul::where('id_pembina', $pembina->id)
            ->get();

        // Buat array untuk menyimpan ekskul per anggota
        $anggotaEkskulData = $anggotaEkskul->map(function ($anggota) use ($pembina) {
            return [
                'anggota' => $anggota,
                'ekskuls' => $pembina->ekskuls, // Ekskul dari pembina
            ];
        });

        return view('pembina.dataAnggotaEkskul', [
            'title' => 'Dashboard Pembina',
            'datas' => $anggotaEkskulData,
            'ekskuls' => $ekskuls
        ]);
    }

    // Create User
    public function saveAnggota(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|min:8|unique:data_anggota_ekskul,nis',
            'noHp' => 'required|string|max:15',
            'email' => 'required|email|unique:data_anggota_ekskul,email',
            'jurusan' => 'required|string|max:255',
        ]);

        try {
            // Ambil ID pembina yang sedang login
            $pembina = Auth::user()->id;

            if (!$pembina) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan!'
                ], 403);
            }

            // Cek apakah anggota sudah ada berdasarkan NIS
            $existingMember = AnggotaEkskul::where('nis', $request->nis)->first();

            if ($existingMember) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anggota dengan NIS ini sudah terdaftar!'
                ], 400);
            }

            // Jika anggota belum ada, buat anggota baru
            AnggotaEkskul::create([
                'name' => $request->name,
                'nis' => $request->nis,
                'email' => $request->email,
                'no_hp' => $request->noHp,
                'jurusan' => $request->jurusan,
                'id_pembina' => $pembina, // Set pembina sesuai dengan yang login
                'pp' => 'profile.png', // Foto profil default
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Anggota berhasil ditambahkan!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    // Data Anggota Eskul END

    public function updateAnggota(Request $request, $id){
        // Debugging: Periksa ID dan data yang dikirim
        // dd($id, $request->all());
        $request->validate([
            'name' => 'required',
            'nis' => 'required|min:8',
            'jurusan' => 'required',
            'noHp' => 'required',
            'email' => 'required',
        ]);

        $update = AnggotaEkskul::findOrFail($id);

        // dd($update);
        $update->name = $request->name;
        $update->email= $request->email;
        $update->jurusan = $request->jurusan;
        $update->no_hp = $request->noHp;
        $update->nis = $request->nis;
        $update->pp = "profile.png";
        $update->save();
        
        return back()->with('success', 'User berhasil diedit!');
    }

    // Data Informasi Eskul 
    public function getDataInformasiEskul()
    {
        return view('pembina.dataInformasiEkskul', ['title' => 'Data Informasi Eskul']);

    }

    // Data Struktur Eskul 
    public function getDataStrukturEskul()
    {
        return view('pembina.dataStrukturEkskul', ['title' => 'Data Struktur Eskul']);

    }

    public function deleteAnggota($id){
        $User = AnggotaEkskul::findOrFail($id);
        $User->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
