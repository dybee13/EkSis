<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pembinaController extends Controller
{
    // Dashboard Pembina 
    public function getDashboardPembina()
    {
        return view('pembina.dashboardPembina', ['title' => 'Dashboard Pembina']);
    }

    // Data Anggota Eskul 
    public function getDataAnggotaEskul()
    {
        return view('pembina.dataAnggotaEkskul', ['title' => 'Data Anggota Eskul']);
    }
    
    // Data Informasi Eskul 
    public function getDataInformasiEskul()
    {
        return view('pembina.dataInformasiEkskul', ['title' => 'Data Informasi Eskul']);
    }
}
