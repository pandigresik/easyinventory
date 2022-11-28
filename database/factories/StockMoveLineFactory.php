<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\StockMoveLine;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockMoveLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockMoveLine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stock_move_id' => $this->faker->word,
        'product_id' => $this->faker->word,
        'storage_location_id' => $this->faker->word,
        'quantity' => $this->faker->numberBetween(0, 999),
        'description' => $this->faker->text($this->faker->numberBetween(5, 80))
        ];
    }
}
