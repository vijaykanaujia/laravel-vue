<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text()
        ];
    }

    /**
     * Indicate that the model's name should be vijay.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function changename()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'vijay',
            ];
        });
    }
}
