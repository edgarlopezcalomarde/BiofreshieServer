<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarritoRequest extends FormRequest
{




    public function authorize()
    {
        return false;
    }


    public function rules()
    {
        return [
            'cartid' => 'required',
            'cart' => 'required',
            'userId' => 'required',
            'date' => 'required',
            'status' => 'required',
            'totalprice' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'cartid.required' => 'Es necesario tener el cartid',
            'cart.required' => 'Es necesario tener el cart',
            'userId.required' => 'Es necesario tener el userId',
            'date.required' => 'Es necesario tener el date',
            'status.required' => 'Es necesario tener el status',
            'totalprice.required' => 'Es necesario tener el totalprice',

        ];

    }
}
