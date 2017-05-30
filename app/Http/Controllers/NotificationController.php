<?php

namespace L2\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function update(Request $request)
    {
        if($request->input('id') === 'all') {
            Auth::user()->unreadNotifications->markAsRead();
            return 'All notifications were marked as read.';
        }

        $notification = Auth::user()->notifications()->find($request->input('id'));
        $notification->markAsRead();
    }

    public function index()
    {
        return Auth::user()->unreadNotifications->each(function($notification){
            switch($notification->type){
                case 'L2\Notifications\ScreenshotSubmitted':
                    $notification["message"] = "New screenshot was submitted by {$notification->data["login"]} , {$notification->created_at->diffForHumans()}. <a href=\"{$notification->data["url"]}\" target=\"_blank\">[check]</a>";
                    break;
                case 'L2\Notifications\TicketReply':
                    $notification["message"] = "New ticket reply from {$notification->data["login"]} , {$notification->created_at->diffForHumans()}.<a href=\"{$notification->data["url"]}\" target=\"_blank\">[check]</a>";
                    break;
                case 'L2\Notifications\TicketSubmitted':
                    $notification["message"] = "New ticket was submitted  by {$notification->data["login"]} , {$notification->created_at->diffForHumans()}.<a href=\"{$notification->data["url"]}\" target=\"_blank\">[check]</a>";
                    break;
                default:
                    $notification["message"] = 'error';
            }

            return $notification;
        });
    }
}

