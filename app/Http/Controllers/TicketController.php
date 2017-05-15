<?php

namespace L2\Http\Controllers;

use Auth;
use L2\Http\Requests\TicketReply as TicketReplyRequest;
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
        return view('tickets.admin.index')->with('tickets', Ticket::getAllTickets());
    }

    public function store(TicketStore $request)
    {
        Ticket::create([
            'display_id' => $this->getRandomId(),
            'topic_id' => $request->input('option'),
            'content' => $request->input('content'),
            'account_id' => Auth::id(),
            'status_id' => 1
        ]);

        session()->flash('ticket_message', 'Ticket was successfully submitted.');
        return redirect()->route('home');
    }

    public function edit(Ticket $ticket,TicketReplyRequest $request)
    {
        $ticket_with_replies = Ticket::admin_info($ticket->id);

        if(Auth::user()->isAdmin()) {
            $data = [
                'info' => $ticket_with_replies,
                'status' => TicketStatus::all()
            ];
            return view('tickets.admin.edit')->with($data);
        }

        $data = [
            'ticket' => $ticket_with_replies,
            'cansubmit' => TicketReply::isAllowedToReply($ticket->id),
        ];

        return view('tickets.user.replies')->with($data);
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

    public function reply(Ticket $ticket, TicketReplyRequest $request)
    {
        TicketReply::create([
            'ticket_id' => $ticket->id,
            'content' => $request->input('content'),
            'account_id' => Auth::id()
        ]);

        if(Auth::user()->isAdmin()) {
            $ticket->update(['status_id' => request('status')]);
            return redirect()->route('ticket.index');
        }

        session()->flash('ticket_message', 'Ticket was successfully replied.');
        return redirect()->route('home');
    }

    public function getRandomId()
    {
        return strtoupper(str_random(4)) . '-' . strtoupper(str_random(4)) . '-' . strtoupper(str_random(4));
    }
}
