<?php

namespace L2\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use L2\Repositories\ScreenshotRepository as Screenshot;

class FileUpload extends FormRequest
{
    public function authorize(Screenshot $screenshot)
    {
        return $screenshot->canUpload();
    }

    public function rules()
    {
        return [
                'screenshot' => [
                    'required' ,
                    'image' ,
                    'max: '.config('custom.screenshot_size')
                ],
                'description' => 'required'
        ];
    }
}
