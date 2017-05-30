<?php

namespace L2\Http\Controllers;

use Auth;
use Illuminate\Database\QueryException;
use L2\Http\Requests\TicketReply as TicketReplyRequest;
use L2\Http\Requests\TicketStore;
use L2\Repositories\TicketReplyRepository as TicketReply;
use L2\Repositories\TicketRepository as Ticket;
use L2\Repositories\TicketStatusRepository as TicketStatus;


class TicketController extends Controller
{
    private $ticket;
    private $ticketStatus;
    private $ticketReply;

    public function __construct(Ticket $ticket, TicketStatus $ticketStatus, TicketReply $ticketReply)
    {
        $this->ticket = $ticket;
        $this->ticketStatus = $ticketStatus;
        $this->ticketReply = $ticketReply;
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['index','destroy']]);
    }

    public function index()
    {
        $tickets = $this->ticket->getAllWithRelationship();

        return view('admin.slugs.tickets.tickets')->with('tickets', $tickets);
    }

    public function store(TicketStore $request)
    {
        $this->ticket->create([
            'display_id' => $this->getRandomId(),
            'topic_id' => $request->input('option'),
            'content' => $request->input('content'),
            'account_id' => Auth::id(),
            'status_id' => 1
        ]);

        session()->flash('ticket_message', 'Ticket was successfully submitted.');
        return redirect()->route('home');
    }

    public function edit($id, TicketReplyRequest $request)
    {
        $ticketWithReplies = $this->ticket->getById($id);

        if(Auth::user()->isAdmin()) {
            $data = [
                'info' => $ticketWithReplies,
                'status' => $this->ticketStatus->getAll()
            ];

            return view('admin.slugs.tickets.tickets-edit')->with($data);
        }

        $data = [
            'ticket' => $ticketWithReplies,
            'cansubmit' => $this->ticketReply->canReply($id),
        ];

        return view('user.tickets.replies')->with($data);
    }

    public function destroy($id)
    {
        $ticket = $this->ticket->getById($id);

        try {
            $ticket->delete();
        }
        catch (QueryException $e)
        {
            return response($e->getMessage(),422);
        }

        return response('Ticket was successfully deleted', 200);
    }

    /*
     * Creates ticket reply
     *
     * @param int $id ticket id
     *
     * @return redirect
     */

    public function reply($ticket, TicketReplyRequest $request)
    {
        $ticket = $this->ticket->getById($ticket);

        $this->ticketReply->create([
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
