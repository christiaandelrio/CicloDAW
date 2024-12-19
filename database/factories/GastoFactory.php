<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gasto>
 */
class GastoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'user_id' => User::factory(), 
                'nombre_gasto' => $this->faker->word,
                'tipo' => $this->faker->randomElement(['personal', 'familiar', 'trabajo']),
                'valor' => $this->faker->randomFloat(2, 5, 500), 
                'fecha' => $this->faker->date(),
                'descripcion' => $this->faker->sentence,
                'categoria' => $this->faker->randomElement(['comida', 'mascota', 'transporte', 'ropa', 'decoracion', 'medico']),
            ];        
    }
}
