<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\DiscountsRequest;
use App\Repositories\Interfaces\DiscountRepositoryInterface;

class DiscountsController extends Controller
{
  public function __construct(DiscountRepositoryInterface $discount)
  {
    $this->discount = $discount;
  }

  public function index()
  {
    try{
      $statusCode =200;
      $discounts = $this->discount->selectAll();
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($discounts, $statusCode);
    }
  }

  public function create(DiscountsRequest $request){
    try{
      $statusCode =201;
      $discount = $this->discount->create($request->all());
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($discount, $statusCode);
    }
  }

  public function store(DiscountsRequest $request){

    try{
      $statusCode =201;
      $discount = $this->discount->store($request->all());
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($discount, $statusCode);
    }
  }

  public function show($id){

    try{
      $statusCode =200;
      $discount = $this->discount->find($id);
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($discount, $statusCode);
    }
  }

  public function update($id){
    try{
      $statusCode =200;
      $discount = $this->discount->update($id);
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($discount, $statusCode);
    }
  }

  public function destroy($id){
    try{
        $statusCode =204;
        $status = $this->discount->delete($id);
     }catch (Exception $e){
         $statusCode= 404;
     }finally{
       return response()->json([], $statusCode);
     }
   }
}
