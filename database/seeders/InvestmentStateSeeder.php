<?php

namespace Database\Seeders;

use App\Models\InvestmentState;
use Illuminate\Database\Seeder;

class InvestmentStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InvestmentState::create(['description' => 'En proceso']);
        InvestmentState::create(['description' => 'Finalizado']);
        InvestmentState::create(['description' => 'Cancelado']);
    }
}
