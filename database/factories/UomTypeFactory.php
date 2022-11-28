<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\UomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class UomTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UomType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->text($this->faker->numberBetween(5, 20)),
        'name' => $this->faker->text($this->faker->numberBetween(5, 255))
        ];
    }
}
