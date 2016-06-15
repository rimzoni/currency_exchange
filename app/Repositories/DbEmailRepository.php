<?php
namespace App\Repositories;

use App\Models\Email;
use Illuminate\Support\Facades\Input;
use App\Repositories\Interfaces\EmailRepositoryInterface;

class DbEmailRepository implements EmailRepositoryInterface {

	public function selectAll()
	{
		return Email::all();
	}

	public function create(array $data)
	{
		return new Email($data);
	}

	public function store(array $data)
	{
		$email = new Email($data);
		$email->save();
		return $email;
	}

	public function find($currencyName)
	{
		return Email::currency($currencyName)->firstOrFail();
	}

	public function update($id){
		$email = Email::find($id);
		if(Input::get('currency'))
		$email->currency = Input::get('currency');
		if(Input::get('from'))
		$email->from = Input::get('from');
		if(Input::get('to'))
		$email->to = Input::get('to');
		if(Input::get('subject'))
		$email->subject = Input::get('subject');
		if(Input::get('template'))
		$email->template = Input::get('template');
		$email->save();

		return $email;
	}

	public function delete($id)
	{
		$email = Email::find($id);
		$email->delete();
		return true;
	}
}
