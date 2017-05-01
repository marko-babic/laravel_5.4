<?php

namespace L2\Http\Controllers;

use L2\Navbar;
use L2\Post;

class MainWebController extends Controller
{
    public function index()
    {
        return view('posts.index')->with(['posts' => Post::where('description_id', 1)->orderBy('created_at','desc')->paginate(2), 'nav_active' => '/']);
    }

    public function generate($slug)
    {
        $navbar = Navbar::all();

        foreach($navbar as $nav) {
            if($slug == $nav->shortcode) {
                return view('nav.sub')->with(['post' => Post::where('description_id', $nav->id)->orderBy('created_at','desc')->first(), 'nav_active' => $slug]);
            }
        }

        return redirect(route('index'));
    }
}
