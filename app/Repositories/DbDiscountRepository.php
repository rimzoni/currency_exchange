<?php
namespace App\Repositories;

use App\Models\Discount;
use App\Repositories\Interfaces\DiscountRepositoryInterface;

class DbDiscountRepository implements DiscountRepositoryInterface {

	public function selectAll()
	{
		return Discount::all();
	}

	public function create(array $data)
	{
		return new Discount($data);
	}

	public function store(array $data)
	{
		$discount = new Discount($data);
		$discount->save();
		return $discount;
	}

	public function find($currencyName)
	{
		return Discount::currency($currencyName)->first();
	}

	public function delete($id)
	{
		$discount = Discount::find($id);
		$discount->delete();
		return true;
	}
}
