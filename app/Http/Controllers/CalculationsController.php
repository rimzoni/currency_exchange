<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CalculateRequest;
use App\Http\Requests\CalculationTotalRequest;
use App\Classes\Calculations;

class CalculationsController extends Controller
{
  public function __construct(Calculations $calculations)
  {
    $this->calculations = $calculations;
  }

  public function calculateRate(CalculateRequest $request){
    $errors = array();
    $exchangeCurrency = $request->input('exchangeCurrency');
    $exchangeValue = $request->input('exchangeValue');
    $sendingAmount = $request->input('sendingAmount');
    $receivingAmount = $request->input('receivingAmount');

    if (empty($exchangeCurrency) && empty($exchangeValue))
      $errors['exchangeRate'] = 'Please select prefered exchanged rate.';

    if (empty($sendingAmount) && empty($receivingAmount) )
      $errors['sendingAmount'] = 'Sending or Receiving amount is required.';

    try{
      $statusCode = 200;
      $response = [];
      if (!empty($errors)){
        $response= ['errors' => $errors];
      }

      $data= array('exchangeCurrency' => $exchangeCurrency,
      'exchangeValue' => $exchangeValue,
      'sendingAmount' => $sendingAmount,
      'receivingAmount' => $receivingAmount);

      $response = $this->calculations->calculateRate($data);

    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($response, $statusCode);
    }
  }

  public function calculateTotalAmount(CalculationTotalRequest $request){
    $errors = array();

    $sendingAmount = $request->input('sendingAmount');
    $surchargeAmount = $request->input('surchargeAmount');

    try{
      $statusCode = 200;
      $response = [];

      $data= array('sendingAmount' => $sendingAmount,
      'surchargeAmount' => $surchargeAmount);

      $response = $this->calculations->calculateTotalOrderAmount($data);

    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($response, $statusCode);
    }
  }
}
