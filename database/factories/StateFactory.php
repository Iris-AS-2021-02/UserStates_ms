<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "serialNumber" => $this->faker->numberBetween($min = 1000, $max = 9999),
            "type" => rand(0,1),
            "publicationDate" => $this->faker->dateTimeBetween('+0 days', '+2 years'),
            "style" => rand(0,1),
            "commentary" => $this->faker->streetName,
            "imageFile" => $this->faker->imageUrl(200, 100),
        ];
    }
}
