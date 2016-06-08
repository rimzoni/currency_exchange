<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\OrdersRequest;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrdersController extends Controller
{
    public function __construct(OrderRepositoryInterface $order)
  	{
  		$this->order = $order;
  	}

    public function index()
  	{
      try{
        $statusCode =200;
        $orders = $this->order->selectAll();
      }catch (Exception $e){
          $statusCode = 400;
      }finally{
        return response()->json($orders, $statusCode);
      }
  	}

    public function create(OrdersRequest $request){
      try{
        $statusCode =201;
        $order = $this->order->create($request->all());
      }catch (Exception $e){
          $statusCode = 400;
      }finally{
        return response()->json($order, $statusCode);
      }
    }

    public function store(OrdersRequest $request){

      try{
        $statusCode =201;
        //store order
        $order = $this->order->store($request->all());
        //return updated order
        $order = $this->order->find($order->id);
      }catch (Exception $e){
          $statusCode = 400;
      }finally{
        return response()->json($order, $statusCode);
      }
    }

    public function update($id){
      try{
        $statusCode =200;

        $status = Input::get('status');
        $order = $this->order->update($id,$status);
      }catch (Exception $e){
          $statusCode = 400;
      }finally{
        return response()->json($order, $statusCode);
      }
    }

    public function updateOrder(array $data){
      try{
        $statusCode =200;
        $order = $this->order->updateOrder($data);
      }catch (Exception $e){
          $statusCode = 400;
      }finally{
        return response()->json($order, $statusCode);
      }
    }

    public function show($id){

      try{
        $statusCode =200;
        $order = $this->order->find($id);
      }catch (Exception $e){
          $statusCode = 400;
      }finally{
        return response()->json($order, $statusCode);
      }
    }

    public function destroy($id){
      try{
          $statusCode =204;
          $status = $this->order->delete($id);
       }catch (Exception $e){
           $statusCode= 404;
       }finally{
         return response()->json([], $statusCode);
       }
     }
}
