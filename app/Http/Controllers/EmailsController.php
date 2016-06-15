<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\EmailsRequest;
use App\Repositories\Interfaces\EmailRepositoryInterface;

class EmailsController extends Controller
{
  public function __construct(EmailRepositoryInterface $email)
  {
    $this->email = $email;
  }

  public function index()
  {
    try{
      $statusCode =200;
      $emails = $this->email->selectAll();
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($emails, $statusCode);
    }
  }

  public function create(EmailsRequest $request){
    try{
      $statusCode =201;
      $email = $this->email->create($request->all());
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($email, $statusCode);
    }
  }

  public function store(EmailsRequest $request){

    try{
      $statusCode =201;
      $email = $this->email->store($request->all());
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($email, $statusCode);
    }
  }

  public function show($id){

    try{
      $statusCode =200;
      $email = $this->email->find($id);
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($email, $statusCode);
    }
  }

  public function update($id){
    try{
      $statusCode =200;
      $email = $this->email->update($id);
    }catch (Exception $e){
        $statusCode = 400;
    }finally{
      return response()->json($email, $statusCode);
    }
  }

  public function destroy($id){
    try{
        $statusCode =204;
        $status = $this->email->delete($id);
     }catch (Exception $e){
         $statusCode= 404;
     }finally{
       return response()->json([], $statusCode);
     }
   }
}
