<?php

namespace App\Http\Requests;

use App\Ticket;
use Illuminate\Foundation\Http\FormRequest;

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
