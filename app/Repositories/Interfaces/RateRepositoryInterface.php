<?php
namespace App\Repositories\Interfaces;

interface RateRepositoryInterface {

	public function selectAll();

	public function find($rateName);

	public function findBySourceAndName($source, $rateName);

	public function create(array $data);

	public function store(array $data);

	public function update(array $data);

	public function delete($id);

}
