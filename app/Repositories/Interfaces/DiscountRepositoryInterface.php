<?php
namespace App\Repositories\Interfaces;

interface DiscountRepositoryInterface {

	public function selectAll();

	public function find($currencyName);

	public function create(array $data);

	public function store(array $data);

	public function update($id);

	public function delete($id);

}
