<?php
namespace database\seeds;

use Illuminate\Database\Seeder;
use App\Models\Email as Email;

class EmailsTableSeeder extends Seeder {

       public function run()
       {
         // clear table
        Email::truncate();
        // add 1st row
        Email::create( [
            'currency' => 'GBP' ,
            'from' => 'sales@currencyexchange.com' ,
            'to' => 'rimzoni@gmail.com' ,
            'subject' => 'Order Details' ,
            'template' => 'emails.order'
        ] );
       }

}
