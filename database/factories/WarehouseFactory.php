<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Warehouse::class;

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
        'description' => $this->faker->boolean
        ];
    }
}
