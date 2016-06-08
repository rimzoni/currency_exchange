<?php
namespace App\Repositories\Interfaces;

interface ActionRepositoryInterface {

	public function selectAll();

	public function find($currencyName);

	public function create(array $data);

	public function store(array $data);

	public function delete($id);

}
