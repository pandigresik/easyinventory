<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\StockMoveType;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockMoveTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockMoveType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->text($this->faker->numberBetween(5, 10)),
        'name' => $this->faker->text($this->faker->numberBetween(5, 50)),
        'sign_value' => $this->faker->boolean,
        'description' => $this->faker->boolean
        ];
    }
}
