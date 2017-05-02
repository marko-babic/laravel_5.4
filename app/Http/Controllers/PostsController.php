<?php

namespace L2\Http\Controllers;

use Auth;
use L2\Http\Requests\PostVerify;
use L2\Navbar;
use L2\Post;

class PostsController extends Controller
{

    private $sites = [
    ];

    function __construct()
    {
        $this->middleware(['auth','admin'],['except' => ['index']]);
        $this->sites = Navbar::all();
    }

    public function index()
    {
        return Post::all();
    }

    public function create()
    {
        return view('posts.create')->with(['sites' => $this->sites]);
    }

    public function store(PostVerify $request)
    {
        Post::create([
            'title' => request('title'),
            'content' => request('content'),
            'author' => Auth::id(),
            'description_id' => request('description'),
        ]);

        return redirect()->route('home');
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post, 'sites' => $this->sites]);
    }

    public function update(PostVerify $request, Post $post)
    {
        $post->update([
            'title' => request('title'),
            'content' => request('content'),
            'author' => Auth::id(),
            'description_id' => request('description'),
        ]);

        return redirect()->route('home');
    }

    public function destroy(Post $post)
    {
        $post->delete();
    }
}
