<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ekskuls;
use Illuminate\Support\Facades\Hash;

class masterController extends Controller
{
    public function index(){
        return view('master/masterDashboard', [
            'title' => 'EkSis || Dashboard Master Admin',
        ]);
    }
    public function dataPembina()
    {
        return view('master.pembinaEkskul', [
            'title' => 'EkSis || Data Pembina Ekskul',
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
            'nip' => 'required|min:18',
            'noHp' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|confirmed',
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
        
        return back()->with('success', 'User berhasil ditambahkan!');
    }

    public function saveEkskul(Request $request){
        
        $request->validate([
            'nama_ekskul' => 'required|string|max:255',
            'users' => 'required|array', // Pastikan users dikirim sebagai array
            'users.*' => 'exists:users,id' // Validasi setiap user_id harus ada di tabel users
        ]);

        // Simpan ekskul baru
    $ekskul = Ekskuls::create([
        'nama_ekskul' => $request->nama_ekskul,
    ]);

    // Hubungkan ekskul dengan pengguna (menyimpan ke ekskul_users)
    $ekskul->users()->attach($request->users);
        
        return back()->with('success', 'Ekskul berhasil ditambahkan!');
    }

    public function deleteEkskul($id){
        $Ekskul = Ekskuls::findOrFail($id);
        $Ekskul->delete();

        return back()->with('success', 'Ekskul berhasil dihapus!');
    }
}
