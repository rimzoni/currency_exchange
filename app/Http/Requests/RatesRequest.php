<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class SurchargeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:6',
            'source' => 'required|max:6',
            'rate' => 'required|numeric'
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
