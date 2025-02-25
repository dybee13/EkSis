<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;

class blogsController extends Controller
{
    public function landingPage()
    {
        $blogs = Blogs::with('images')->get();
        return view('users.mainEkskul', compact('blogs'));
    }
}
