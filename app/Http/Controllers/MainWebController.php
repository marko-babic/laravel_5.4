<?php

namespace L2\Http\Controllers;

use L2\Navbar;
use L2\Post;

class MainWebController extends Controller
{
    public function index()
    {
        $data = [
            'posts' => Post::where('description_id', 1)->orderBy('created_at','desc')->paginate(2),
            'navActive' => '/'
        ];

        return view('posts.index')->with($data);
    }

    public function generate($nav)
    {
        $nav = Navbar::where('shortcode',$nav)->first();

        $data = [
            'post' => Post::where('description_id', $nav->id)->orderBy('created_at','desc')->first(),
            'navActive' => $nav->shortcode,
        ];

        return view('nav.sub')->with($data);
    }
}
