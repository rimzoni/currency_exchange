<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	        Model::unguard();
          $this->call('SurchargesTableSeeder');
                 $this->command->info('Surcharge table seeded!');
          $this->call('ActionsTableSeeder');
                $this->command->info('Actions table seeded!');
          $this->call('DiscountsTableSeeder');
                $this->command->info('Discounts table seeded!');
          $this->call('EmailsTableSeeder');
                $this->command->info('Emails table seeded!');
    }
}
