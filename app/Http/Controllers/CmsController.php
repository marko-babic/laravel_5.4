<?php

namespace L2\Http\Controllers;

use Auth;
use L2\Repositories\NavbarRepository as Navbar;
use L2\Repositories\PostRepository as Post;

class CmsController extends Controller
{
    private $navbar;
    private $post;

    public function __construct(Navbar $navbar, Post $post)
    {
        $this->navbar = $navbar;
        $this->post = $post;
    }

    public function index()
    {
        $adminData = [
            'unreadNotifications' => $this->generateViews(Auth::User()->unreadNotifications),
            'navigation' => $this->navbar->getAll(),
            'posts' => $this->post->getAll(),
        ];

        return view('admin.slugs.CMS.index')->with($adminData);
    }

    public function generateViews($notifications)
    {
        foreach($notifications as &$notification)
        {
            $notification["view"] = 'notifications.'.last(explode('\\',$notification["type"]));
        }

        return $notifications;
    }
}
