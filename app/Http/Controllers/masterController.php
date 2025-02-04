<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class masterController extends Controller
{
    public function index(){
        return view('master/masterDashboard', [
            'title' => 'Dashboard Master Admin',
        ]);
    }
    public function dataPembina(){
        return view('master/pembinaEkskul', [
            'title' => 'Data Pembina Ekskul',
            'datas' => User::get()
        ]);
    }
}
