<?php

namespace App\Http\Controllers;

Use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function update(Request $request)
    {
        $notification = Auth::user()->notifications()->find(request('id'));
        $notification->markAsRead();
    }
}

