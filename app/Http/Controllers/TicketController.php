<?php

namespace L2\Http\Controllers;

use Auth;
use L2\Http\Requests\TicketStore;
use L2\Ticket;
use L2\TicketReply;
use L2\TicketStatus;


class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['index','destroy']]);
    }

    public function index()
    {
        return view('tickets.admin.index')->with('tickets', Ticket::alltickets());
    }

    public function store(TicketStore $request)
    {
        Ticket::create([
            'display_id' => strtoupper(str_random(4)) . '-' . strtoupper(str_random(4)) . '-' . strtoupper(str_random(4)),
            'topic_id' => request('option'),
            'content' => request('content'),
            'account_id' => Auth::id(),
            'status_id' => 1
        ]);

        Auth::User()->notifyAdmin('ticket');
        session()->flash('ticket_message', 'Ticket was successfully submitted.');
        return redirect('/home#submitticket');
    }

    public function edit(Ticket $ticket)
    {
        if(Auth::user()->isAdmin()) {
            return view('tickets.admin.edit')->with(
                [
                    'info' => Ticket::admin_info($ticket->id),
                    'status' => TicketStatus::all()
                ]);
        } else {
            if($ticket->account_id == Auth::id()) {
                return view('tickets.user.replies')->with(
                    [
                        'ticket' => Ticket::admin_info($ticket->id),
                        'cansubmit' => TicketReply::cansubmitreply($ticket->id),
                    ]);
            }
        }

        return redirect('/home');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
    }

    /*
     * Creates ticket reply
     *
     * @param int $id ticket id
     *
     * @return redirect
     */

    public function reply(Ticket $ticket)
    {
        if (!$user_id = $this->checkOwner($ticket->id)) {
            return redirect('/home');
        }

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'content' => request('content'),
            'account_id' => Auth::id()
        ]);

        if(Auth::user()->isAdmin()) {
            Ticket::whereId($ticket->id)->update(['status_id' => request('status')]);
            Auth::user()->notifyUserTicket($user_id, $ticket->id);
            return redirect()->route('ticket.index');
        }

        Auth::user()->notifyAdmin('ticket_reply');
        session()->flash('ticket_message', 'Ticket was successfully replied.');
        return redirect()->route('home');
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
}
