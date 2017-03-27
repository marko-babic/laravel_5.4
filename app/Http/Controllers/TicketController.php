<?php

namespace App\Http\Controllers;

use Auth;
use \App\Ticket;
use \App\TicketReply;
use \App\Http\Requests\TicketStore;
use Illuminate\Http\Request;


class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['index','edit','destroy']]);
    }

    public function index()
    {
        return view('tickets.index')->with('tickets', Ticket::alltickets());
    }

    public function store(TicketStore $request)
    {
        Ticket::create([
            'topic_id' => request('option'),
            'content' => request('content'),
            'account_id' => Auth::user()->id,
            'status_id' => 1
        ]);

        session()->flash('ticket_message', 'Ticket was successfully submitted.');
        return redirect('/home#submitticket');
    }

    public function edit($id)
    {
        //
        $info = Ticket::admin_info($id);
        return view('tickets.edit')->with('info',$info);
    }

    public function destroy($id)
    {
        Ticket::where('id',$id)->forceDelete();
    }

    public function reply($id)
    {
        TicketReply::create([
            'ticket_id' => $id,
            'content' => request('content'),
            'account_id' => Auth::user()->id
        ]);

        if(Auth::user()->isAdmin()) {
            Ticket::where('id', $id)->update(['status_id' => request('status')]);

            return redirect('/ticket');
        }

        session()->flash('ticket_message', 'Ticket was successfully replied.');
        return redirect('/home#submitticket');
    }
}
