<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketStore;
use App\Ticket;
use App\TicketReply;
use Auth;


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
            'account_id' => Auth::id(),
            'status_id' => 1
        ]);

        Auth::User()->notifyAdmin('ticket');
        session()->flash('ticket_message', 'Ticket was successfully submitted.');
        return redirect('/home#submitticket');
    }

    public function edit($id)
    {
        if ($this->ticketExists($id))
            return view('tickets.edit')->with('info', Ticket::admin_info($id));

        return redirect('/home');
    }

    public function ticketExists($id)
    {
        if (Ticket::whereId($id)->exists())
            return true;

        return false;
    }

    /*
     * Creates ticket reply
     *
     * @param int $id ticket id
     *
     * @return redirect
     */

    public function destroy($id)
    {
        if ($this->ticketExists($id))
            Ticket::whereId($id)->forceDelete();
    }


    /*
     * verify if submitting user owns the ticket, or if admin is replying. Either way, they're both allowed to process.
     */

    public function reply($id)
    {

        if (!$this->checkOwner($id)) {
            return redirect('/home');
        }

        TicketReply::create([
            'ticket_id' => $id,
            'content' => request('content'),
            'account_id' => Auth::id()
        ]);

        if(Auth::user()->isAdmin()) {
            Ticket::whereId($id)->update(['status_id' => request('status')]);
            return redirect('/ticket');
        }

        session()->flash('ticket_message', 'Ticket was successfully replied.');
        return redirect('/home#submitticket');
    }

    public function checkOwner($id)
    {

        if ($ticket = Ticket::whereId($id)->firstOrFail()) {
            if ($ticket->account_id == Auth::id() || Auth::user()->isAdmin())
                return true;
        }

        return false;
    }
}
