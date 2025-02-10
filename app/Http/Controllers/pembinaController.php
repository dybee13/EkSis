<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class pembinaController extends Controller
{
    // Dashboard Pembina 
    public function getDashboardPembina()
    {
        return view('pembina.pembinaDashboard', ['title' => 'Dashboard Pembina']);
    }
    
    // Data Anggota Eskul START
    // Get Data Anggota
    public function getDataAnggotaEskul()
    {
        $datas = User::where('role', 'user')->get();
        return view('pembina.dataAnggotaEkskul', ['title' => 'Data Anggota Eskul', 'datas' => $datas]);
    }
    // Create User
    public function createUser(Request $request){
        $request->validate([
            'name' => 'required',
            'nis' => 'required|min:18',
            'noHp' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);        
        dd($request->all());
        $create = new User();
        $create->name = $request->name;
        $create->email= $request->email;
        $create->no_hp = $request->noHp;
        $create->nis = $request->nis;
        $create->pp = "profile.png";
        $create->role = "user";
        $create->password = Hash::make($request->password);
        // $create->save();
        dd($create->save());

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
}
