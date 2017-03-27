<?php

namespace App\Http\Controllers;

use Auth;
use \App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    function __construct()
    {
        $this->middleware(['auth','admin'],['except' => ['index']]);
    }

    public function index()
    {
        //
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
            'author' => Auth::user()->id
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

        $post = Post::find($id);
        $post->title = request('title');
        $post->content = request('content');
        $post->author = Auth::user()->id;
        $post->save();

        return redirect('/home');
    }

    public function destroy($id)
    {
        return Post::destroy($id);
    }
}
