<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ekskuls;

class masterController extends Controller
{
    public function index(){
        return view('master/masterDashboard', [
            'title' => 'EkSis || Dashboard Master Admin',
        ]);
    }
    public function dataPembina()
    {
        return view('master/pembinaEkskul', [
            'title' => 'EkSis || Data Pembina Ekskul',
            'datas' => User::where('role', 'pembina')->with('ekskuls.ekskul')->get() // Ambil hanya user dengan role 'pembina'
        ]);
    }
    public function dataEkskul()
    {
        $ekskuls = Ekskuls::with('pembina')->get();

        return view('master.daftarEkskul', [
            'title' => 'Data Ekskul & Pembina',
            'datas' => $ekskuls
        ]);
    }

    public function savePembina(Request $request){
        $request->validate([
            'nama' => 'required',
            'judul' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
        ]);

        $create = new User();
        $create->author = $request->nama;
        $create->judul= $request->judul;
        $create->slug = "gibrannn";
        $create->excerpt = $request->excerpt;
        $create->body = $request->body;
        $create->user_id = $request->user_id;
        // $create->id = $request->author;
        $create->save();

        //return redirect()->back()->with('success', 'Blog Post create successfully');
        // return redirect()->to('/blog')->with('success', 'Blog Post create successfully');

        return response()->json(['message' => 'data berhasil masuk', 'blog' => $create], 200);
    }
}
