<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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
            'title'         => $this->faker->text(15),
            'description'   => $this->faker->paragraph,
            'stock'         => $this->faker->numberBetween($min = 1, $max = 10),
            'photo'         => $this->faker->imageUrl(),
            'price'         => $this->faker->numberBetween(8,100)
        ];
    }
}
