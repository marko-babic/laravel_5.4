<?php

namespace L2\Http\Controllers;

use Auth;
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

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
            ]
        );

        Post::create([
            'title' => request('title'),
            'content' => request('content'),
            'author' => Auth::id(),
            'description_id' => request('description'),
        ]);

        return redirect('home');
    }

    public function show($id)
    {
        return Post::find($id);
    }

    public function edit($id)
    {
        return view('posts.edit')->with(['post' => Post::find($id), 'sites' => $this->sites]);
    }

    public function update($id)
    {
        $this->validate(request(), [
                'title' => 'required',
                'content' => 'required'
            ]
        );

        $post = Post::whereId($id);
        $post->update([
            'title' => request('title'),
            'content' => request('content'),
            'author' => Auth::id(),
            'description_id' => request('description'),
        ]);

        return redirect('home');
    }

    public function destroy($id)
    {
        return Post::destroy($id);
    }
}
