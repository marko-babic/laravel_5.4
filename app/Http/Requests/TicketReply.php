<?php

namespace L2\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use L2\Repositories\TicketRepository as Ticket;

class TicketReply extends FormRequest
{

    public function authorize(Ticket $model)
    {
        $ticket = $model->getById($this->ticket);

        if (!is_null($ticket) && ($ticket->account_id === $this->user()->id || $this->user()->isAdmin())) {
            return true;
        }

        return false;
    }

    public function rules()
    {
        return [

        ];
    }
}
