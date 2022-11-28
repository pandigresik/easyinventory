<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\StockAdjustmentLine;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockAdjustmentLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockAdjustmentLine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->word,
        'storage_location_id' => $this->faker->word,
        'count_quantity' => $this->faker->numberBetween(0, 999),
        'onhand_quantity' => $this->faker->numberBetween(0, 999),
        'transaction_date' => $this->faker->date('Y-m-d'),
        'description' => $this->faker->boolean,
        'state' => $this->faker->text($this->faker->numberBetween(5, 4096))
        ];
    }
}
