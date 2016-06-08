<?php
namespace App\Repositories;

use App\Models\Surcharge;
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

	public function delete($id)
	{
		$surcharge = Surcharge::find($id);
		$surcharge->delete();
		return true;
	}
}
