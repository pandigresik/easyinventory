<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\StockProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockProduct::class;

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
        'quantity' => $this->faker->numberBetween(0, 999)
        ];
    }
}
