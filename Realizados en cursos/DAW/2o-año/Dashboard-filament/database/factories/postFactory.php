<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\post>
 */
class postFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence,
            'cuerpo' => $this->faker->paragraph,
            'imagen' => $this->faker->imageUrl(),
            'usuario_id' => rand(1, 10),
            'categoria_id' => rand(1, 5),
        ];
    }
}
