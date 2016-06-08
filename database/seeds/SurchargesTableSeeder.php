<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use App\Models\Surcharge as Surcharge;

class SurchargesTableSeeder extends Seeder {

       public function run()
       {
         // clear table
        Surcharge::truncate();
        // add 1st row
        Surcharge::create( [
          'currency' => 'ZAR' ,
          'percentage' => '7.5'
        ] );
        // add 2st row
        Surcharge::create( [
          'currency' => 'GBP' ,
          'percentage' => '5'
        ] );
        // add 3st row
        Surcharge::create( [
          'currency' => 'EUR' ,
          'percentage' => '5'
        ] );
        // add 4st row
        Surcharge::create( [
            'currency' => 'KES' ,
            'percentage' => '2.5'
        ] );
       }
}
