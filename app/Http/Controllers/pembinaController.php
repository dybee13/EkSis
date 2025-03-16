<?php

namespace App\Http\Controllers;

use App\Models\AbsenEkskul;
use App\Models\User;
use App\Models\Ekskuls;
use App\Models\EkskulUsers;
use Illuminate\Http\Request;
use App\Models\AnggotaEkskul;
use App\Models\StrukturEkskul;
use App\Models\InformasiEkskul;
use App\Models\JadwalEkskul;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class pembinaController extends Controller
{

    public function getDashboardPembina()
    {
        // Ambil ID pembina yang sedang login
        $pembina = Auth::user();

        // Ambil ID ekskul yang dimiliki oleh pembina dari tabel ekskul_users
        $idEkskulPembina = $pembina->ekskulUsers->pluck('id_ekskul');

        // Ambil ekskul yang dimiliki pembina dan hitung jumlah anggota
        $ekskuls = Ekskuls::whereIn('id', $idEkskulPembina)
            ->withCount('anggotaEkskul') // Menghitung jumlah anggota dalam ekskul
            ->get();

        return view('pembina.pembinaDashboard', [
            'title' => 'Dashboard Pembina',
            'ekskuls' => $ekskuls
        ]);
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

        // Ambil ID ekskul yang dimiliki oleh pembina melalui tabel ekskul_users
        $idEkskulPembina = $pembina->ekskulUsers()->pluck('id_ekskul');

        // Ambil semua anggota yang memiliki id_ekskul yang sesuai dengan ekskul pembina dan urutkan berdasarkan nama anggota
        $anggotaEkskul = AnggotaEkskul::whereIn('id_ekskul', $idEkskulPembina)
        ->orderBy('name', 'asc') // Urutkan berdasarkan nama secara abjad
        ->get(); // Ambil semua kolom dari tabel anggota_eksuls

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
            'name' => 'required',
            'nis' => 'required|unique:data_anggota_ekskul,nis|min:8',
            'noHp' => 'required|digits_between:10,13',
            'email' => 'required|email|unique:data_anggota_ekskul,email',
            'jurusan' => 'required',
        ],[
            'name.required' => 'Nama wajib diisi.',
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS ini sudah digunakan, silakan gunakan NIS lain.',
            'noHp.required' => 'Nomor HP wajib diisi.',
            'noHp.numeric' => 'Diisi dengan Nomor.',
            'noHp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 13 digit.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan, silakan gunakan email lain.',
            // 'password.required' => 'Password wajib diisi.',
            // 'password.min' => 'Password minimal harus :min karakter.',
            // 'password.confirmed' => 'Konfirmasi password tidak cocok.',
            // 'password_confirmation.required' => 'Password wajib diisi.'
        ]);

        try {
            // Ambil ID pembina yang sedang login
            $pembina = Auth::user();

            // Ambil ID ekskul yang dimiliki oleh pembina melalui tabel ekskul_users
            $idEkskulPembina = $pembina->ekskulUsers()->pluck('id_ekskul')->first();

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
                'id_ekskul' => $idEkskulPembina, // Set pembina sesuai dengan yang login
                'pp' => 'profile.png', // Foto profil default
            ]);

            return back()->with('success', 'User berhasil ditambah!');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // public function updateUser(Request $request, $id){
    //     $request->validate([
    //         'name' => 'required',
    //         'nis' => 'required|unique:users,nis',
    //         'jurusan' => 'required',
    //         'noHp' => 'required|numeric|digits_between:10,13',
    //         'email' => 'required|email|unique:users,email',
    //     ],[
    //         'name.required' => 'Nama wajib diisi.',
    //         'nis.required' => 'NIP wajib diisi.',
    //         'nis.unique' => 'NIP ini sudah digunakan, silakan gunakan NIP lain.',
    //         'noHp.required' => 'Nomor HP wajib diisi.',
    //         'noHp.numeric' => 'Diisi dengan Nomor.',
    //         'noHp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 13 digit.',
    //         'email.required' => 'Email wajib diisi.',
    //         'email.email' => 'Format email tidak valid.',
    //         'email.unique' => 'Email ini sudah digunakan, silakan gunakan email lain.',
    //     ]);

    //     $update = User::find($id);
    //     $update->name = $request->name;
    //     $update->email= $request->email;
    //     $update->no_hp = $request->noHp;
    //     $update->nis = $request->nis;
    //     $update->pp = "profile.png";
    //     $update->role = "pembina";
    //     $update->password = Hash::make($request->password);
    //     $update->save();
        
    //     return back()->with('success', 'User berhasil diedit!');
    // }

    // Data Anggota Eskul END

    public function updateAnggota(Request $request, $id){
        // Debugging: Periksa ID dan data yang dikirim
        // dd($id, $request->all());
        $request->validate([
            'name' => 'required',
            'nis' => [
                'required',
                Rule::unique('data_anggota_ekskul', 'nis')->ignore($id)
            ],
            'jurusan' => 'required',
            'noHp' => 'required|numeric|digits_between:10,13',
            'email' => [
                'required',
                Rule::unique('data_anggota_ekskul', 'email')->ignore($id)
            ]
        ],[
            'name.required' => 'Nama wajib diisi.',
            'jurusan.required' => 'Jurusan wajib diisi.',
            'nis.required' => 'NIP wajib diisi.',
            'nis.unique' => 'NIP ini sudah digunakan, silakan gunakan NIP lain.',
            'noHp.required' => 'Nomor HP wajib diisi.',
            'noHp.numeric' => 'Diisi dengan Nomor.',
            'noHp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 13 digit.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan, silakan gunakan email lain.',
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
    // Data Anggota Eskul END

    // Data Informasi Eskul 
    public function getDataInformasiEskul(User $user, EkskulUsers $ekskulUsers)
    {
        $userEkskul = EkskulUsers::with([
            'user', 
            'ekskul.informasiEkskul', 
            'ekskul.strukturEkskul', 
            'ekskul.anggotaEkskul'
        ])->where('id_user', Auth::id())->first(); 
    
        if (!$userEkskul) {
            return abort(404, 'Data ekskul tidak ditemukan');
        }
    
        $ekskul = $userEkskul->ekskul;
        $informasiEkskul = $ekskul->informasiEkskul;
        $anggotaEkskul = $ekskul->anggotaEkskul;
        $strukturEkskul = $ekskul->strukturEkskul;

        $user = Auth::user();
        $idEkskul = $user->ekskulUsers()->first()->id_ekskul ?? null;

        $jadwal = JadwalEkskul::where('id_ekskul', $idEkskul)->get();
    
        // Mengambil nama pembina berdasarkan relasi EkskulUsers
        $pembina = User::whereHas('ekskulUsers', function ($query) use ($ekskul) {
            $query->where('id_ekskul', $ekskul->id);
        })->where('role', 'pembina')->first(); // Ambil satu pembina
    
        return view('pembina.dataInformasiEkskul', [
            'title' => 'Data Informasi Eskul',
            'ekskul' => $ekskul,
            'user' => $user,
            'informasiEkskul' => $informasiEkskul,
            'anggotaEkskul' => $anggotaEkskul,
            'strukturEkskul' => $strukturEkskul,
            'jadwal' => $jadwal,
            'pembina' => $pembina // Kirim pembina ke view
        ]);
    }    

    public function saveDataInformasiEkskul(Request $request)
    {
        $userId = User::with('ekskuls')->find(Auth::id());
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
        }
        
        $eskulId = $userId->ekskuls->first();
        
        if (!$eskulId) {
            return response()->json(['success' => false, 'message' => 'User tidak memiliki ekskul'], 400);
        }
        // Validasi data
        $validated = $request->validate([
            'id_ekskul' => 'numeric',
            'tgl_berdiri' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]
    );
    
    
        // Simpan file logo jika diunggah
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('images/ekstrakulikuler', 'public');
        }

        // Tambahkan id_ekskul secara manual
        $validated['id_ekskul'] = $eskulId->id;
    
            // Simpan ke database
            InformasiEkskul::create($validated);
            return redirect()->back()->with('success', 'Informasi ekskul berhasil disimpan.');
        }

   
        public function saveDataStrukturEkskul(Request $request) {
            $request->validate([
                'id_ekskul' => 'exists:ekskuls,id',
                'ketua_ekskul' => 'nullable|string',
                'waketu_ekskul' => 'nullable|string',
                'sekretaris' => 'nullable|string',
                'bendahara' => 'nullable|string',
            ]);
          // Ambil hanya data yang dikirim
        $data = $request->only(['id_ekskul', 'ketua_ekskul', 'waketu_ekskul', 'sekretaris', 'bendahara']);

                $struktur = StrukturEkskul::create($data);
                return redirect()->back()->with('success','Struktur ekskul berhasil disimpan.');
        }

    public function deleteAnggota($id){
        $User = AnggotaEkskul::findOrFail($id);
        $User->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }

    public function saveJadwalEkskul(Request $request)
    {
        $request->validate([
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $user = Auth::user();
        $idEkskul = $user->ekskulUsers()->first()->id_ekskul ?? null;

        JadwalEkskul::create([
            'id_ekskul' => $idEkskul,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->back()->with('success','Jadwal ekskul berhasil disimpan.');
    }

    public function rekapAbsen(Request $request)
    {
        $pengurus = Auth::user();
        $idEkskul = $pengurus->ekskulUsers()->pluck('id_ekskul');

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

        return view('pembina.rekapAbsen', compact('rekapAbsen', 'title', 'statusFilter'));
    }
}
