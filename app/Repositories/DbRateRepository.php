<?php
namespace App\Repositories;

use App\Models\ExchangedRate;
use App\Repositories\Interfaces\RateRepositoryInterface;

class DbRateRepository implements RateRepositoryInterface {

	public function selectAll()
	{
		return ExchangedRate::all();
	}

	public function create(array $data)
	{
		return new ExchangedRate($data);
	}

	public function store(array $data)
	{
		$exchangedRate = new ExchangedRate($data);
		$exchangedRate->save();
		return $exchangedRate;
	}

	public function find($rateName)
	{
		return ExchangedRate::rate($rateName)->get();
	}

	public function findBySourceAndName($source, $rateName){
		return ExchangedRate::rateBySource($source,$rateName)->first();
	}

	public function update(array $data){
		$exchangedRate = ExchangedRate::rate($data['name'])->first();
    $exchangedRate->name = $data['name'];
    $exchangedRate->source = $data['source'];
    $exchangedRate->rate = $data['rate'];
    $exchangedRate->save();
	}

	public function delete($id)
	{
		$exchangedRate = ExchangedRate::find($id);
		$exchangedRate->delete();
		return true;
	}

	public function showRateBySourceCurrency($rateName,$sourceName){
		return ExchangedRate::rateBySource($sourceName,$rateName)->get();
	}
}
