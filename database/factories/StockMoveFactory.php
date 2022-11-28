<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\StockMove;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockMoveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockMove::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'transaction_date' => $this->faker->date('Y-m-d'),
        'number' => $this->faker->text($this->faker->numberBetween(5, 25)),
        'references' => $this->faker->text($this->faker->numberBetween(5, 50)),
        'responsbility' => $this->faker->text($this->faker->numberBetween(5, 50)),
        'warehouse_id' => $this->faker->word,
        'stock_move_type_id' => $this->faker->word
        ];
    }
}
