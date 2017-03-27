<?php

namespace App\Http\Requests;

use \App\Screenshot;
use Illuminate\Foundation\Http\FormRequest;

class FileUpload extends FormRequest
{

    public function authorize()
    {
        return Screenshot::canupload();
    }

    public function rules()
    {
        return [
                'screenshot' => 'required | mimes:jpeg,jpg,png,png | max: '.config('custom.screenshot_size'),
                'description' => 'required'
        ];
    }
}
