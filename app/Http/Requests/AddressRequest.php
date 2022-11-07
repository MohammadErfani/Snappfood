<?php

namespace App\Http\Requests;

use App\Rules\AddressRule;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'address'=>'required',
            'latitude'=>'required|numeric',
            'longitude'=>'required|numeric'
        ];
    }
}
