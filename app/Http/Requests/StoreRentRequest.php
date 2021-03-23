<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRentRequest extends FormRequest
{
    public function authorize()
    {
        dd(Auth::user());
        return \Gate::allows('rent_create');
    }

    public function rules()
    {
        return [
            'car_id' => [
                'required',
            ],
            'date_from' => [
                'required',
            ],
        ];
    }
}
