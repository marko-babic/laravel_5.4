<?php

namespace L2\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NavbarCheck extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'description' => 'required',
            'shortcode' => [
                'required' ,
                'unique:navbar,shortcode'
            ],
            'navbar' => 'required'
        ];
    }
}
