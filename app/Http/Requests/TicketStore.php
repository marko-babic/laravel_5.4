<?php

namespace L2\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use L2\Ticket;

class TicketStore extends FormRequest
{

    /*
     * @return boolean
     */

    public function authorize()
    {
        return Ticket::cansubmit();
    }

    public function rules()
    {
        return [
            'option' => 'required',
            'content' => 'required'
        ];
    }

}
