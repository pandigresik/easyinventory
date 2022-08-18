<?php

namespace Database\Factories\Base;

use App\Models\Base\Customers;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text($this->faker->numberBetween(5, 50)),
        'description' => $this->faker->text($this->faker->numberBetween(5, 100)),
        'address' => $this->faker->text($this->faker->numberBetween(5, 100)),
        'user_id' => $this->faker->word
        ];
    }
}
