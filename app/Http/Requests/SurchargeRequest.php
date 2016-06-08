<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class SurchargeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'currency' => 'required',
            'percentage' => 'required|numeric|between:0,100'
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
