<?php

namespace App\Classes;
use App\Repositories\Interfaces\SurchargeRepositoryInterface;

class Calculations {

    public function __construct(SurchargeRepositoryInterface $surcharge)
    {
      $this->surcharge = $surcharge;
    }

    private function calculateReceivingAmount($receivingAmount, $exchangeValue){
      return $receivingAmount / $exchangeValue;
    }

    private function calculateSendingAmount($sendingAmount, $exchangeValue){
      return $sendingAmount * $exchangeValue;
    }

    public function calculateRate($data = [])
    {
        $exchangeCurrency = $data['exchangeCurrency'];
        $exchangeValue = $data['exchangeValue'];
        $sendingAmount = $data['sendingAmount'];
        $receivingAmount = $data['receivingAmount'];
        $response =[];
        if($sendingAmount!=null && $sendingAmount!=''){
          $sendingAmount = $this->calculateSendingAmount($sendingAmount,$exchangeValue);
          $response = ['method' => 'PAY', 'value' => $sendingAmount];
        }else if ($receivingAmount!=null && $receivingAmount!='' && $sendingAmount==null && empty($errors)){
          $receivingAmount = $this->calculateReceivingAmount($receivingAmount,$exchangeValue);
          $response = ['method' => 'PURCHASE', 'value' => $receivingAmount];
        }
        return $response;
    }

    public function calculateSurchargeByAmount($data = []){
        $currencyName = $data['currencyName'];
        $sendingAmount = $data['sendingAmount'];

        $surcharge = $this->surcharge->find($currencyName);

        $percentage = floatval($surcharge->percentage);
        $amount = ($sendingAmount * $percentage)/100 ;

        $response = ['percentage' => $percentage,
                   'chargeValue' => $amount];

        return $response;
    }

    public function calculateTotalOrderAmount($data =[]){
      $sendingAmount = $data['sendingAmount'];
      $surchargeAmount = $data['surchargeAmount'];

      $total_amount = $sendingAmount + $surchargeAmount;

      $response = ['total_amount' => $total_amount];

      return $response;
    }

    public function calculateDiscountAmount($data = [], $discount_percentage = null){
        $paid_amount = $data['order']->paid_amount;
        $surcharge_amount = $data['order']->surcharge_amount;
        $currencyName = $data['order']->exchanged_currency;
        $total_amount = $data['order']->total_amount;

        $surcharge = $this->surcharge->find($currencyName);

        $percentage = floatval($discount_percentage);
        $amount = ($total_amount * $percentage)/100 ;

        $response = ['percentage' => $percentage,
                   'discountValue' => $amount];

        return $response;
    }
}
