<?php

namespace L2\Http\Controllers;

use L2\Post;

class MainWebController extends Controller
{
    public function index()
    {
        return view('posts.index')->with('posts',Post::where('description_id', 1)->orderBy('created_at','desc')->paginate(2));
    }

    public function start()
    {
        return view('nav.start')->with('post', Post::where('description_id', 2)->orderBy('created_at','desc')->first());
    }

    public function rules()
    {
        return view('nav.rules')->with('post', Post::where('description_id',3)->orderBy('created_at','desc')->first());
    }
    
    public function faq()
    {
        return view('nav.faq')->with('post', Post::where('description_id', 4)->orderBy('created_at','desc')->first());
    }

    public function donate()
    {
        return view('donate.index')->with('post', Post::where('description_id',5)->orderBy('created_at','desc')->first());
    }
}
