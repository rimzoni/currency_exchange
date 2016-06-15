<?php
namespace App\Repositories;

use App\Models\Action;
use Illuminate\Support\Facades\Input;
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

	public function update($id){
		$action = Action::find($id);
		if(Input::get('currency'))
		$action->currency = Input::get('currency');
		if(Input::get('has_action'))
		$action->has_action = Input::get('has_action');
		if(Input::get('action'))
		$action->action = Input::get('action');

		$action->save();

		return $action;
	}

	public function delete($id)
	{
		$action = Action::find($id);
		$action->delete();
		return true;
	}
}
