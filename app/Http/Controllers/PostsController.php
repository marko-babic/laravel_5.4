<?php

namespace L2\Http\Controllers;

use Auth;
use Illuminate\Database\QueryException;
use L2\Http\Requests\PostVerify;
use L2\Repositories\NavbarRepository as Navbar;
use L2\Repositories\PostRepository as Post;

class PostsController extends Controller
{
    private $sites;
    private $post;

    function __construct(Post $post, Navbar $navigationBar)
    {
        $this->middleware('admin');
        $this->sites = $navigationBar;
        $this->post = $post;
    }
/*
    public function index()
    {
        return $this->post->getAll();
    }
*/
    public function create()
    {
        return view('admin.slugs.CMS.posts.create')->with(['sites' => $this->sites->getAll()]);
    }

    public function store(PostVerify $request)
    {
        $this->post->create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author' => Auth::id(),
            'description_id' => $request->input('description'),
        ]);

        return redirect()->route('cms');
    }
/*
    public function show($id)
    {
        return $this->post->getById($id);
    }
*/
    public function edit($id)
    {
        $post = $this->post->getById($id);

        $data = [
            'post' => $post,
            'sites' => $this->sites->getAll()
        ];

        return view('admin.slugs.CMS.posts.edit')->with($data);
    }

    public function update(PostVerify $request, $id)
    {
        $post = $this->post->getById($id);

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author' => Auth::id(),
            'description_id' => $request->input('description'),
        ]);

        return redirect()->route('home');
    }

    public function destroy($id)
    {
        $post = $this->post->getById($id);

        try {
            $post->delete();
        }
        catch (QueryException $e)
        {
            return response($e->getMessage(),422);
        }

        return response('Post was successfully deleted', 200);
    }
}
