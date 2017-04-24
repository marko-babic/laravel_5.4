<?php

namespace L2\Http\Controllers;

use Auth;

class NotificationController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function update()
    {
        $notification = Auth::user()->notifications()->find(request('id'));
        $notification->markAsRead();
    }
}

