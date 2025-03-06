<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;

class blogsController extends Controller
{
    public function Blogs()
    {
        $blogs = Blogs::with('blogImages')
                ->whereIn('keterangan', ['activities', 'achievments'])
                ->get();

        $blogsachi = Blogs::with('blogImages')
                ->where('keterangan', 'achievments')
                ->get();

        return view('users.mainEkskul', compact('blogs', 'blogsachi'));
    }
}
