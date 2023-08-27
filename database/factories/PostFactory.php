<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Factory realizará pruebas a la BD con los siguientes datos falsos
        return [
            'titulo' => $this->faker->sentence(5),
            'descripcion' => $this->faker->sentence(20),
            'imagen' => $this->faker->uuid().'.jpg',
            'user_id' => $this->faker->randomElement([9,10]) // id de usuarios existentes de la BD
        ];
    }
}
