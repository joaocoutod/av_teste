<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\clientes>
 */
class ClientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->randomElement(['João Lucas', 'Lucas Couto', 'Ana Celina', 'Ana Clara', 'Ana Vitoria']),
            'email' => fake()->unique()->safeEmail(),
            'telefone' => $this->faker->phoneNumber,
            'menssagem' => $this->faker->randomElement([
                'Lorem ipsum dolor sit amet, consectetur adipiscing.',
                'enim ad minim veniam, quis nostrud exercitation ull.'
            ])
        ];
    }
}
