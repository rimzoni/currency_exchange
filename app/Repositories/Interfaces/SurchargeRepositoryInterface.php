<?php
namespace App\Repositories\Interfaces;

interface SurchargeRepositoryInterface {

	public function selectAll();

	public function find($id);

	public function create(array $data);

	public function store(array $data);

	public function update($id);

	public function delete($id);

}
