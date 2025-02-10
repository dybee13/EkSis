<?php

namespace App\Http\Controllers;

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
        $datas = User::where('role', 'pengurus')->get();
        return view('pembina.dataAnggotaEkskul', ['title' => 'Data Anggota Eskul', 'datas' => $datas]);
    }
    // Create User
    public function saveAnggota(Request $request){
        $request->validate([
            'name' => 'required',
            'nis' => 'required|min:18',
            'noHp' => 'required',
            'email' => 'required',
            'jurusan' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        try {
            // Ambil ID Pembina yang sedang login
            $pembina_id = Auth::id();

            // Cari ekskul yang dimiliki oleh pembina
            $ekskul = EkskulUsers::where('id_user', $pembina_id)->first();

            if (!$ekskul) {
                return response()->json(['success' => false, 'message' => 'Anda tidak memiliki ekskul yang dapat diisi anggota!'], 403);
            }

            // Simpan anggota baru
            $anggota = User::create([
                'name' => $request->name,
                'nis' => $request->nis,
                'email' => $request->email,
                'no_hp' => $request->noHp,
                'jurusan' => $request->jurusan,
                'pp' => 'profile.png',
                'password' => bcrypt($request->password),
                'role' => 'pengurus', // Pastikan role siswa
            ]);

            // Tambahkan anggota ke ekskul_users
            EkskulUsers::create([
                'id_user' => $anggota->id,
                'id_ekskul' => $ekskul->id,
            ]);

            return response()->json(['success' => true, 'message' => 'Anggota berhasil ditambahkan ke ekskul!']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    // Data Anggota Eskul END
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
        $User = User::findOrFail($id);
        $User->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
