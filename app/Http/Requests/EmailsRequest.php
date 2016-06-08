<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class EmailsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'currency' => 'required|max:6',
            'from' => 'required|email',
            'to' => 'required|email',
            'subject' => 'required',
            'template' => 'required',
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
