<?php

namespace Database\Seeders;

use App\Models\Investment;
use App\Models\Investor;
use Illuminate\Database\Seeder;

class InvestorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Investor::factory()->has(
            Investment::factory()
            ->count(15)
            ->state(function (array $attributes, Investor $investor) {
                return ['investor_id' => $investor->id];
            })
        )->count(5)->create();
    }
}
