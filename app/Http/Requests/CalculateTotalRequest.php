<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class CalculateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'surchargeAmount' => 'required|numeric',
            'sendingAmount' => 'required|numeric'
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
