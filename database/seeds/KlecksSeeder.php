<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KlecksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Customer::class, 10)->create();
        factory(App\Issue::class, 3)->create();
        factory(App\Adformat::class, 12)
          ->make()
          ->each(function($adformat) {
            $adformat->issue_id = rand(1, 3);
            $adformat->save();
          });
        factory(App\Advertisement::class, 36)
          ->make()
          ->each(function($ad) {
            $ad->customer_id = rand(1, 10);
            $ad->adformat_id = rand(1, 12);
            $ad->save();
          });
        $user = new App\User();
        $user->name = 'Daniel';
        $user->email = 'daniel.thul@gmail.com';
        $user->password = bcrypt('password');
        $user->save();
    }
}
