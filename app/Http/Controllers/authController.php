<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class authController extends Controller
{
    public function index(){
        return view('login', [
            'title' => 'Login - EkSis',
        ]);
    }
    public function login(Request $request){
        Session::put('key', 'Pesan ini akan bertahan sampai dihapus.');
        $request->validate([
            'email' => 'required',
            'pw' => 'required'
        ], [
            'email.required' => 'email wajib diisi',
            'pw.required' => 'pw wajib diisi'
        ]);

        $info = [
            'email' => $request->email,
            'password' => $request->pw
        ];

        if(Auth::attempt($info)){

            // data user yang login
            $user = Auth::user();

            // menyimpan data user pada session
            Session::put('user', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'nohp' => $user->no_hp,
                'nip' => $user->nip,
                'nis' => $user->nis,
                'kelas' => $user->kelas,
                'jurusan' => $user->jurusan,
                'pp' => $user->pp,
                'role' => $user->role,
            ]);

            //login sukses
            if(Auth::user()->role == 'master'){
                return redirect()->to('/masterDashboard')->with('success', 'Login successfully');
            }elseif(Auth::user()->role == 'pembina'){
                return redirect()->to('/pembinaDashboard')->with('success', 'Login successfully');
            }elseif(Auth::user()->role == 'pengurus'){
                return redirect()->to('/pengurusDashboard')->with('success', 'Login successfully');
            }
        }else{
            //login gagal
            return redirect()->withErrors('email dan password yang dimasukkan tidak valid')->withInput();
        }
    }

    public function logout(){
        Auth::logout(); // Logout user dari sistem
        Session::forget('user'); // Hapus session user
        return redirect()->to('/');
    }
}
