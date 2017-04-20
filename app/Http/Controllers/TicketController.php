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
        $this->middleware('admin', ['only' => ['index','destroy']]);
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
        if($test = $this->checkOwner($id)) {
            if(Auth::user()->isAdmin()) {
                return view('tickets.edit')->with('info', Ticket::admin_info($id));
            } else {
                $info["ticket"] = Ticket::admin_info($id);
                $info["cansubmit"] = TicketReply::cansubmitreply($id);
                return view('tickets.replies')->with('info', $info);
            }
        }

        return redirect('/home');
    }

    public function destroy($id)
    {
        if ($this->ticketExists($id))
            Ticket::whereId($id)->forceDelete();
    }

    /*
     * Creates ticket reply
     *
     * @param int $id ticket id
     *
     * @return redirect
     */

    public function reply($id)
    {
        if (!$user_id = $this->checkOwner($id)) {
            return redirect('/home');
        }

        TicketReply::create([
            'ticket_id' => $id,
            'content' => request('content'),
            'account_id' => Auth::id()
        ]);

        if(Auth::user()->isAdmin()) {
            Ticket::whereId($id)->update(['status_id' => request('status')]);
            Auth::user()->notifyUserTicket($user_id);
            return redirect('/ticket');
        }

        Auth::user()->notifyAdmin('ticket_reply');
        session()->flash('ticket_message', 'Ticket was successfully replied.');
        return redirect('/home#submitticket');
    }

    /*
     * verify if submitting user owns the ticket, or if admin is replying. Either way, they're both allowed to process.
     */

    public function checkOwner($id)
    {
        if ($ticket = Ticket::whereId($id)->first()) {
            if ($ticket->account_id == Auth::id() || Auth::user()->isAdmin())
                return $ticket->account_id;
        }

        return false;
    }

    public function ticketExists($id)
    {
        if (Ticket::whereId($id)->exists())
            return true;

        return false;
    }
}
