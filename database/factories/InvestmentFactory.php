<?php

namespace Database\Factories;

use App\Models\Investment;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvestmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Investment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mount' => $this->faker->randomFloat(2,1,100),
            'percentage' => $this->faker->randomFloat(2,1,100),
            'ended_at' => now()->addYear(),
        ];
    }
}
