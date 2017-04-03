<?php

namespace App\Http\Requests;

use \App\Vote;
use Illuminate\Foundation\Http\FormRequest;

class VoteVerify extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Vote::canvote($this->id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required | integer'
        ];
    }
}
