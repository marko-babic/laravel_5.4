<?php

namespace L2\Http\Controllers;

use L2\Repositories\NavbarRepository as Navbar;
use L2\Repositories\PostRepository as Post;

class MainWebController extends Controller
{
    private $post;
    private $navbar;

    public function __construct(Post $post, Navbar $navbar)
    {
        $this->post = $post;
        $this->navbar = $navbar;
    }

    public function index()
    {
        $data = [
            'posts' => $this->post->getIndexPage(),
            'navActive' => '/'
        ];

        return view('nav.main')->with($data);
    }

    public function generate($nav)
    {
        $nav = $this->navbar->getShortcode($nav);

        if(is_null($nav))
            return redirect()->route('index');

        $data = [
            'post' => $this->post->getSubPage($nav->id),
            'navActive' => $nav->shortcode,
        ];

        return view('nav.sub')->with($data);
    }
}
