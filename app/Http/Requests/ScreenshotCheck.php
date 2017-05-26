<?php

namespace L2\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use L2\Repositories\ScreenshotRepository as Screenshot;

class ScreenshotCheck extends FormRequest
{
    public function authorize(Screenshot $model)
    {
        $screenshot = $model->getById($this->route('screenshot'));
        return is_null($screenshot) ?  false : true;
    }


    public function rules()
    {
        return [
            //
        ];
    }
}
