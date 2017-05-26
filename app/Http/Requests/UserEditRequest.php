<?php

namespace L2\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'login' => 'required',
            'accessLevel' => 'required',
            'displayName' => 'required',
            'email' => 'email | required'
        ];
    }
}
