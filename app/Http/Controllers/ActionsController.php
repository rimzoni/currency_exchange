<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ActionsRequest;
use App\Repositories\Interfaces\ActionRepositoryInterface;

class ActionsController extends Controller
{
  public function __construct(ActionRepositoryInterface $action)
  {
    $this->action = $action;
  }

  public function index()
  {
    try{
      $statusCode =200;
      $actions = $this->action->selectAll();
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($actions, $statusCode);
    }
  }

  public function create(ActionsRequest $request){
    try{
      $statusCode =201;
      $action = $this->action->create($request->all());
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($action, $statusCode);
    }
  }

  public function store(ActionsRequest $request){

    try{
      $statusCode =201;
      $action = $this->action->store($request->all());
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($action, $statusCode);
    }
  }

  public function show($currencyName){

    try{
      $statusCode =200;
      $action = $this->action->find($currencyName);
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($action, $statusCode);
    }
  }

  public function destroy($id){
    try{
        $statusCode =204;
        $status = $this->action->delete($id);
     }catch (Exception $e){
         $statusCode= 404;
     }finally{
       return response()->json([], $statusCode);
     }
   }
}
