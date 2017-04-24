<?php

namespace L2\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use L2\Vote;

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
