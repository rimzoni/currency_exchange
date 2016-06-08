<?php
namespace database\seeds;

use Illuminate\Database\Seeder;
use App\Models\Discount as Discount;

class DiscountsTableSeeder extends Seeder {

       public function run()
       {
         // clear table
        Discount::truncate();
        // add 1st row
        Discount::create( [
            'currency' => 'EUR' ,
            'percentage' => '2'
        ] );
       }
}
