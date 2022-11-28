<?php

namespace Database\Factories\Inventory;

use App\Models\Inventory\Uom;
use Illuminate\Database\Eloquent\Factories\Factory;

class UomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Uom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text($this->faker->numberBetween(5, 255)),
        'category_id' => $this->faker->numberBetween(0, 999),
        'factor' => $this->faker->numberBetween(0, 999),
        'rounding' => $this->faker->numberBetween(0, 999),
        'uom_type_id' => $this->faker->word,
        'uom_category_id' => $this->faker->word
        ];
    }
}
