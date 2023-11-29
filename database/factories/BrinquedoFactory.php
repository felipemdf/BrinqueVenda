<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brinquedo>
 */
class BrinquedoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuario_id' => null,
            'nome' => $this->faker->word,
            'descricao' => $this->faker->sentence,
            'capacidade' => $this->faker->numberBetween(1, 100),
            'valor_ingresso' => $this->faker->randomFloat(2, 1, 50),
            'status_funcionamento' => $this->faker->randomElement(['ATIVO', 'MANUTENÇÃO', 'INATIVO'])
        ];
    }
}
