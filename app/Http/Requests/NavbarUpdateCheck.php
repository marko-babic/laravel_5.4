<?php

namespace L2\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use L2\Repositories\NavbarRepository as Navbar;

class NavbarUpdateCheck extends FormRequest
{

    public function authorize(Navbar $model)
    {
        $navbar = $model->getShortcode($this->route('id'));

        if(is_null($navbar))
            return true;

        return ($navbar->id === $this->route('id')) ? true : false;
    }

    public function rules()
    {
        return [
            'description' => 'required',
            'shortcode' => [
                'required' ,
            ],
            'navbar' => 'required'
        ];
    }
}
