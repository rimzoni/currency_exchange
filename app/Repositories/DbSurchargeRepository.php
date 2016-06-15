<?php
namespace App\Repositories;

use App\Models\Surcharge;
use Illuminate\Support\Facades\Input;
use App\Repositories\Interfaces\SurchargeRepositoryInterface;

class DbSurchargeRepository implements SurchargeRepositoryInterface {

	public function selectAll()
	{
		return Surcharge::all();
	}

	public function create(array $data)
	{
		return new Surcharge($data);
	}

	public function store(array $data)
	{
		$surcharge = new Surcharge($data);
		$surcharge->save();
		return $surcharge;
	}

	public function find($currencyName)
	{
		return Surcharge::currency($currencyName)->firstOrFail();
	}

	public function update($id){
		$surcharge = Surcharge::find($id);
		if(Input::get('currency'))
		$surcharge->currency = Input::get('currency');
		if(Input::get('percentage'))
		$surcharge->percentage = Input::get('percentage');
		$surcharge->save();

		return $surcharge;
	}

	public function delete($id)
	{
		$surcharge = Surcharge::find($id);
		$surcharge->delete();
		return true;
	}
}
