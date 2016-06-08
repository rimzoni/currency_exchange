<?php

namespace App\Classes;

use App\Repositories\Interfaces\RateRepositoryInterface;

class Rates {

    public function __construct(RateRepositoryInterface $exchangeRate)
    {
      $this->exchangeRate = $exchangeRate;
    }

    public function getExternalRates(){

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL,"http://apilayer.net/api/live?access_key=6df6f2f684627d35e7d82a9c565252d6&source=USD&currencies=ZAR,GBP,EUR,KES");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $curl_response = curl_exec($ch);

      $response = json_decode($curl_response);
      $source = $response->source;
      $response_rate = [];

      if($response->success){
        foreach($response->quotes as $key => $rateValue)
        {
          $rateName = str_replace('USD', '', $key);
          //rate exist
          $rateObject = $this->exchangeRate->findBySourceAndName($source,$rateName);
            if(empty($rateObject)){
              $data= array('source' => $source,
              'name' => $rateName,
              'rate' => $rateValue);

              $createdRate = $this->exchangeRate->store($data);
              $response_rate[] = ['source' => $source , 'name' => $rateName, 'rate' => $rateValue];
            }else{
              // var_dump($rateObject);
              if($rateObject->rate != $rateValue){
                $data= array('source' => $source,
                'name' => $rateName,
                'rate' => $rateValue);
                $updateRate = $this->exchangeRate->update($data);
                $response_rate[] = ['source' => $source , 'name' => $rateName, 'rate' => $rateValue];
              }
            }
        }
      }

      if ($errno = curl_errno($ch)) {
          echo $errno;
      }

      curl_close ($ch);

      return $response_rate;
    }
}
