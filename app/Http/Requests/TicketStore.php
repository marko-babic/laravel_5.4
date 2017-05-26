<?php

namespace L2\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use L2\Repositories\TicketRepository as Ticket;

class TicketStore extends FormRequest
{
    public function authorize(Ticket $ticket)
    {
        return $ticket->canSubmit();
    }

    public function rules()
    {
        return [
            'option' => 'required',
            'content' => 'required'
        ];
    }

}
