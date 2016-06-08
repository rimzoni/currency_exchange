<?php
namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface {

	public function selectAll();

	public function find($id);

	public function create(array $data);

	public function store(array $data);

	public function update($id, $status);

	public function updateOrder(array $order);

	public function delete($id);

}
