<?php
namespace database\seeds;
use Illuminate\Database\Seeder;
use App\Models\Action as Action;

class ActionsTableSeeder extends Seeder {

       public function run()
       {
         // clear table
        Action::truncate();
        // add 1st row
        Action::create( [
            'currency' => 'ZAR' ,
            'has_action' => false ,
            'action' => 'none'
        ] );
        // add 2st row
        Action::create( [
            'currency' => 'GBP' ,
            'has_action' => true ,
            'action' => 'email'
        ] );
        // add 3st row
        Action::create( [
            'currency' => 'EUR' ,
            'has_action' => true ,
            'action' => 'discount'
        ] );
        // add 4st row
        Action::create( [
            'currency' => 'KES' ,
            'has_action' => false ,
            'action' => 'none'
        ] );
      }
}
