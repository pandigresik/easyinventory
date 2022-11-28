<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\StorageLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class StorageLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StorageLocation::class;

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
        'description' => $this->faker->boolean,
        'warehouse_id' => $this->faker->word,
        'parent_id' => $this->faker->word
        ];
    }
}
