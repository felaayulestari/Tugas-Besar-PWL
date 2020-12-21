<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::take(2)->get();
        return view('home', ['posts' => $posts]);
    }
}
