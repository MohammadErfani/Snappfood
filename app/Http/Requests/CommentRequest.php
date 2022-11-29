<?php

namespace App\Http\Requests;

use App\Rules\OrderDeliveredRule;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'cart_id'=>['required','numeric','unique:comments,order_id',new OrderDeliveredRule()],
            'score'=>['required','numeric','min:1','max:5'],
            'message'=>['required','string']
        ];
    }
    public function messages()
    {
        return [
            'cart_id.unique'=>'You Already add comment for this cart'
        ];
    }

}
