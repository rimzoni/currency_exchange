<?php
namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class DbOrderRepository implements OrderRepositoryInterface {

	public function selectAll()
	{
		return Order::all();
	}

	public function create(array $data)
	{
		return new Order($data);
	}

	public function store(array $data)
	{
		$order = new Order($data);
		//quick fix for total_amount
		$order->total_amount = $order->paid_amount + $order->surcharge_amount;
		$order->save();
		return $order;
	}

	public function update($id,$status){
		$order = Order::find($id);
		$order->status = $status;
		$order->fill($order['attributes']);
		$order->save();
		return $order;
	}

	public function updateOrder(array $data){
		$order = Order::find($data['id']);
		$order->total_amount = $data['total_amount'];
		$order->discount_amount = $data['discount_amount'];
		$order->discount_percentage = $data['discount_percentage'];
		$order->fill($order['attributes']);
		$order->save();
		return $order;
	}

	public function find($id)
	{
		return Order::find($id);
	}

	public function delete($id)
	{
		$order = Order::find($id);
		$order->delete();
		return true;
	}
}
