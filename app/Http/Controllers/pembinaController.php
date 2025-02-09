<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ekskuls;
use Illuminate\Support\Facades\Hash;

class pembinaController extends Controller
{
    public function index(){
        return view('pembina/pembinaDashboard', [
            'title' => 'EkSis || Dashboard Pembina',
        ]);
    }
}
