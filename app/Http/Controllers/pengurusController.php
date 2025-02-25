<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pengurusController extends Controller
{
    // Dashboard Pengurus 
    public function getDashboardPengurus()
    {
        return view('pengurus.pengurusDashboard', ['title' => 'Dashboard Pengurus']);
    }

    public function getDataBlogs()
    {
        return view('pengurus.dataBlogs', ['title' => 'Data Blogs']);
    }
}
