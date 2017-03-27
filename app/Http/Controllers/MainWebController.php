<?php

namespace App\Http\Controllers;

use \App\Post;
use Illuminate\Http\Request;

class MainWebController extends Controller
{
    public function index()
    {
        return view('posts.index')->with('posts',Post::orderBy('created_at','desc')->paginate(2));
    }

    public function start()
    {
        return view('nav.start');
    }

    public function faq()
    {
        return view('nav.faq');
    }

    public function donate()
    {
        return view('donate.index');
    }

    public function rules()
    {
        return view('nav.faq');
    }
}
