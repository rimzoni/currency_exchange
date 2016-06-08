<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class WebAppController extends Controller
{
    public function home(){
      return view('home');
    }

    public function surcharges(){
      return view('surcharges');
    }

    public function orders(){
      return view('orders');
    }

    public function rates(){
      return view('rates');
    }

    public function actions(){
      return view('actions');
    }

    public function emails(){
      return view('emails');
    }

    public function discounts(){
      return view('discounts');
    }
}
