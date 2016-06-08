<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class CalculateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'exchangeCurrency' => 'required|max:6',
            'exchangeValue' => 'required|numeric',
            'sendingAmount' => 'required_without:receivingAmount|numeric',
            'receivingAmount' => 'required_without:sendingAmount|numeric'
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
