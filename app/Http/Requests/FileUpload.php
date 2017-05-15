<?php

namespace L2\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use L2\Screenshot;

class FileUpload extends FormRequest
{

    /*
     * @return boolean
     */
    public function authorize()
    {
        return Screenshot::canupload();
    }

    public function rules()
    {
        return [
                'screenshot' => 'required | image | max: '.config('custom.screenshot_size'),
                'description' => 'required'
        ];
    }
}
