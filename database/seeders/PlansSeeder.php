<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::truncate();

        $Plan = Plan::insert([[
          'name' => 'Bronce',
          'minimum_fee' => 100,
          'maximum_fee' => 300,
          'annual_membership' => 24,
          'commission' => 50,
          'logo' => 'bronce.png'
        ],[
            'name' => 'Plata',
            'minimum_fee' => 301,
            'maximum_fee' => 1000,
            'annual_membership' => 60,
            'commission' => 50,
            'logo' => 'plata.png'
          ],[
            'name' => 'Oro',
            'minimum_fee' => 1001,
            'maximum_fee' => 5000,
            'annual_membership' => 120,
            'commission' => 50,
            'logo' => 'oro.png'
          ],[
            'name' => 'Platino',
            'minimum_fee' => 5001,
            'maximum_fee' => 10000,
            'annual_membership' => 144,
            'commission' => 45,
            'logo' => 'platino.png'
          ],[
            'name' => 'Diamante',
            'minimum_fee' => 10001,
            'maximum_fee' => 50000,
            'annual_membership' => 240,
            'commission' => 45,
            'logo' => 'diamante.png'
          ]]);
          Plan::create([
            'name' => 'VIP',
            'minimum_fee' => 50001,
            'annual_membership' => 300,
            'commission' => 45,
            'logo' => 'diamante.png'
          ]);
    }
}
