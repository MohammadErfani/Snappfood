<?php

namespace App\Http\Requests;

use App\Rules\AddressRule;
use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'name'=>'required',
            'phone'=>'required',        //other validation doesn't add for faster add content with fake filler
            'bankAccount'=>'required',
            'restaurantCategory'=>'required',
            'picture'=>'mimes:jpg,png|max:2048',
            'address'=>'required',
            'lat'=>[new AddressRule()],
            'lng'=>[new AddressRule()]

        ];
    }
}
