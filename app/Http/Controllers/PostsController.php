<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    function __construct()
    {
        $this->middleware(['auth','admin'],['except' => ['index']]);
    }

    public function index()
    {
        return Post::all();
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required',
            'content' => 'required'
            ]
        );

        Post::create([
            'title' => request('title'),
            'content' => request('content'),
            'author' => Auth::id()
        ]);

        return redirect('/home');
    }

    public function show($id)
    {
        return Post::find($id);
    }

    public function edit($id)
    {
        return view('posts.edit')->with('post', Post::find($id));
    }

    public function update(Request $request, $id)
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
        ]);

        return redirect('/home');
    }

    public function destroy($id)
    {
        return Post::destroy($id);
    }
}
