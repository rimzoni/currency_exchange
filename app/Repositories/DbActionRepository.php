<?php
namespace App\Repositories;

use App\Models\Action;
use App\Repositories\Interfaces\ActionRepositoryInterface;

class DbActionRepository implements ActionRepositoryInterface {

	public function selectAll()
	{
		return Action::all();
	}

	public function create(array $data)
	{
		return new Action($data);
	}

	public function store(array $data)
	{
		$action = new Action($data);
		$action->save();
		return $action;
	}

	public function find($currencyName)
	{
		return Action::currency($currencyName)->firstOrFail();
	}

	public function delete($id)
	{
		$action = Action::find($id);
		$action->delete();
		return true;
	}
}
