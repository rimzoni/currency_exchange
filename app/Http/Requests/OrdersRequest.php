<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class OrdersRequest extends FormRequest
{
    public function rules()
    {
        return [
            'exchanged_currency' => 'required|max:6',
            'exchanged_rate' => 'required|numeric',
            'surcharge_percentage' => 'required|numeric|between:0,100',
            'purchased_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'surcharge_amount' => 'required|numeric',
            'discount_amount' => 'numeric',
            'discount_percentage' => 'numeric|between:0,100',
            'total_amount' => 'numeric',
            'status' => 'integer'
        ];
    }


    public function authorize()
    {
    //     // Only allow logged in users
    //     // return \Auth::check();
    //     // Allows all users in
        return true;
    }

    // OPTIONAL OVERRIDE
    public function response(array $errors)
    {
        $statusCode = 400;
        return response()->json($errors, $statusCode);
    }
}
