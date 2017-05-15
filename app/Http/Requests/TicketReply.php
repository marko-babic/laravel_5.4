<?php

namespace L2\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class TicketReply extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $ticket = $this->route('ticket');

        if ($ticket->account_id == Auth::id() || Auth::user()->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }
}
