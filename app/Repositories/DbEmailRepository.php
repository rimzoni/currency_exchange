<?php
namespace App\Repositories;

use App\Models\Email;
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

	public function delete($id)
	{
		$email = Email::find($id);
		$email->delete();
		return true;
	}
}
