<?php

namespace Database\Seeders;

use App\Models\Calculator;
use Illuminate\Database\Seeder;

class CalculatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Calculator::create([
            'value' => 100
        ]);
    }
}
