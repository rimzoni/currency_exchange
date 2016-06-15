<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\SurchargeRequest;
use App\Http\Requests\SurchargeAmountRequest;
use App\Classes\Calculations;
use App\Repositories\Interfaces\SurchargeRepositoryInterface;

class SurchargesController extends Controller
{
  public function __construct(SurchargeRepositoryInterface $surcharge, Calculations $calculations)
  {
    $this->surcharge = $surcharge;
    $this->calculations = $calculations;
  }

  public function index()
  {
    try{
      $statusCode =200;
      $surcharges = $this->surcharge->selectAll();;
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($surcharges, $statusCode);
    }
  }

  public function create(SurchargeRequest $request){
    try{
      $statusCode =201;
      $surcharge = $this->surcharge->create($request->all());
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($surcharge, $statusCode);
    }
  }

  public function store(SurchargeRequest $request){

    try{
      $statusCode =201;
      $surcharge = $this->surcharge->store($request->all());
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($surcharge, $statusCode);
    }
  }

  public function show($currencyName){

    try{
      $statusCode =200;
      $surcharge = $this->surcharge->find($currencyName);

    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($surcharge, $statusCode);
    }
  }

  public function update($id){
    try{
      $statusCode =200;
      $surcharge = $this->surcharge->update($id);
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($surcharge, $statusCode);
    }
  }

  public function getAmountByPurchase(SurchargeAmountRequest $request){

    try{
      $statusCode =200;
      $sendingAmount =$request->input('sendingAmount');
      $currencyName = $request->input('currencyName');

      $data= array('currencyName' => $currencyName,
      'sendingAmount' => $sendingAmount);

      $response = $this->calculations->calculateSurchargeByAmount($data);

    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($response, $statusCode);
    }
  }

  public function destroy($id){
    try{
        $statusCode =204;
        $status = $this->surcharge->delete($id);
     }catch (Exception $e){
         $statusCode= 404;
     }finally{
       return response()->json($status, $statusCode);
     }
   }
}
