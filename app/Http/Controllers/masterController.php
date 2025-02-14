<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ekskuls;
use Illuminate\Support\Facades\Hash;

class masterController extends Controller
{
    public function getUsers()
    {
        $users = User::where('role', 'pembina')->get(); // Ambil hanya guru pembina
        return response()->json($users);
    }
    public function index(){
        return view('master/masterDashboard', [
            'title' => 'Dashboard Master Admin',
        ]);
    }
    public function dataPembina()
    {
        return view('master.pembinaEkskul', [
            'title' => 'Data Pembina Ekskul',
            'datas' => User::where('role', 'pembina')->with('ekskuls.ekskul')->get() // Ambil hanya user dengan role 'pembina'
        ]);
    }
    
    public function dataEkskul()
    {
        $ekskuls = Ekskuls::with('pembina')->get();

        return view('master.listEkskul', [
            'title' => 'Data Ekskul',
            'datas' => $ekskuls,
            'pembinas' => User::where('role', 'pembina')->get()
        ]);
    }

    public function savePembina(Request $request){
        
        $request->validate([
            'name' => 'required',
            'nip' => 'required|unique:users,nip',
            'noHp' => 'required|numeric|digits_between:10,13',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ],
        [ 
            'name.required' => 'Nama wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP ini sudah digunakan, silakan gunakan NIP lain.',
            'noHp.required' => 'Nomor HP wajib diisi.',
            'noHp.numeric' => 'Diisi dengan Nomor.',
            'noHp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 13 digit.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan, silakan gunakan email lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password_confirmation.required' => 'Password wajib diisi.'
        ]);

        $create = new User();
        $create->name = $request->name;
        $create->email= $request->email;
        $create->no_hp = $request->noHp;
        $create->nip = $request->nip;
        $create->pp = "profile.png";
        $create->role = "pembina";
        $create->password = Hash::make($request->password);
        $create->save();
        
        return back()->with('success');
    }

    public function saveEkskul(Request $request){
        
        $request->validate([
            'nama_ekskul' => 'required|string|max:255',
            'users' => 'required|array', // Pastikan users dikirim sebagai array
            'users.*' => 'exists:users,id' // Validasi setiap user_id harus ada di tabel users
        ],
        [
            'nama_eskul.required' => 'Nama Eskul wajid diisi',
        ]);

        // Cek apakah semua user yang dikirim memiliki role 'pembina'
        $invalidUsers = User::whereIn('id', $request->users)
        ->where('role', '!=', 'pembina')
        ->pluck('id');

        if ($invalidUsers->isNotEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan ekskul! Beberapa pengguna bukan pembina.',
                'invalid_users' => $invalidUsers
            ], 400);
        }

        try {
            // Simpan ekskul baru
            $ekskul = Ekskuls::create([
                'nama_ekskul' => $request->nama_ekskul,
            ]);
    
            // Hubungkan ekskul dengan pengguna (menyimpan ke ekskul_users)
            $ekskul->users()->attach($request->users);
    
            return response()->json(['success' => true, 'message' => 'Ekskul berhasil ditambahkan!']);
    
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteEkskul($id){
        $Ekskul = Ekskuls::findOrFail($id);
        
        // Hapus relasi ekskul dengan pengguna sebelum menghapus ekskul
        $Ekskul->users()->detach();
        
        $Ekskul->delete();

        return response()->json(['message' => 'Ekskul berhasil dihapus!']);
    }

    public function deletePembina($id){
        $User = User::findOrFail($id);
        $User->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }

    public function updatePembina(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'nip' => 'required|unique:users,nip',
            'noHp' => 'required|numeric|digits_between:10,13',
            'email' => 'required|email|unique:users,email',
        ],[
            'name.required' => 'Nama wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP ini sudah digunakan, silakan gunakan NIP lain.',
            'noHp.required' => 'Nomor HP wajib diisi.',
            'noHp.numeric' => 'Diisi dengan Nomor.',
            'noHp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 13 digit.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan, silakan gunakan email lain.',
        ]);

        $update = User::find($id);
        $update->name = $request->name;
        $update->email= $request->email;
        $update->no_hp = $request->noHp;
        $update->nip = $request->nip;
        $update->pp = "profile.png";
        $update->role = "pembina";
        $update->password = Hash::make($request->password);
        $update->save();
        
        return back()->with('success');
    }

    public function dataEdit($id)
    {
        $ekskul = Ekskuls::with('users')->findOrFail($id);
        $users = User::all(); // Ambil semua user untuk pilihan

        return response()->json([
            'ekskul' => $ekskul,
            'users' => $users
        ]);
    }


    public function updateEkskul(Request $request, $id)
    {
        $request->validate([
            'nama_ekskul' => 'required|string|max:255',
            'users' => 'required|array',
            'users.*' => 'exists:users,id'
        ],  [
            'nama_eskul.required' => 'Nama Eskul wajid diisi',
        ]);

        $ekskul = Ekskuls::findOrFail($id);

        // Update nama ekskul
        $ekskul->update([
            'nama_ekskul' => $request->nama_ekskul
        ]);

        // Update hubungan user dengan ekskul (sinkronisasi)
        $ekskul->users()->sync($request->users);

        return response()->json(['message' => 'Ekskul berhasil diperbarui!']);
    }

}
