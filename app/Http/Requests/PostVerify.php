<?php

namespace L2\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostVerify extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
        ];
    }
}
