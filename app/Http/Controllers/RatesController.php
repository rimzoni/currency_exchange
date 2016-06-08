<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\RatesRequest;
use App\Repositories\Interfaces\RateRepositoryInterface;
use App\Classes\Rates;

class RatesController extends Controller
{
  public function __construct(RateRepositoryInterface $rate, Rates $externalRates)
  {
    $this->rate = $rate;
    $this->externalRates = $externalRates;
  }

  public function index()
  {
    try{
      $statusCode =200;
      $rates = $this->rate->selectAll();
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($rates, $statusCode);
    }
  }

  public function create(RatesRequest $request){
    try{
      $statusCode =201;
      $rate = $this->rate->create($request->all());
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($rate, $statusCode);
    }
  }

  public function store(RatesRequest $request){

    try{
      $statusCode =201;
      $rate = $this->rate->store($request->all());
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($rate, $statusCode);
    }
  }

  public function find($rateName){

    try{
      $statusCode =200;
      $rate = $this->rate->find($rateName);

    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($rate, $statusCode);
    }
  }

  public function showRateBySourceCurrency($sourceName,$rateName){

    try{
      $statusCode =200;
      $rate = $this->rate->showRateBySourceCurrency($sourceName,$rateName);

    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($rate, $statusCode);
    }
  }


  public function destroy($id){
    try{
        $statusCode =204;
        $rate = $this->rate->delete($id);
     }catch (Exception $e){
         $statusCode= 404;
     }finally{
       return response()->json([], $statusCode);
     }
   }

   public function updateExternalRate(){
     try{
       $statusCode =200;
       $rates = $this->externalRates->getExternalRates();
     }catch (Exception $e){
         $statusCode = 400;
     }finally{
       return response()->json($rates, $statusCode);
     }
   }
}
