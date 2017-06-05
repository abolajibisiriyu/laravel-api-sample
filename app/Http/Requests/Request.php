<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Dingo\Api\Exception\ValidationHttpException;

abstract class Request extends FormRequest
{

    //override default validation

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationHttpException($validator->errors(), null, []);
    }

}
