<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\StockAdjustment;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockAdjustmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockAdjustment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->text($this->faker->numberBetween(5, 25)),
        'transaction_date' => $this->faker->date('Y-m-d'),
        'description' => $this->faker->boolean
        ];
    }
}
