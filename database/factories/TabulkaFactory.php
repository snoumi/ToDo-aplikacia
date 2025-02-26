<?php

namespace Database\Factories;

use App\Models\Tabulka;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tabulka>
 */
class TabulkaFactory extends Factory
{
    protected $model = Tabulka::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(rand(1, 3), true),
            'description' => $this->faker->sentence(rand(5, 15)),
            'status' => $this->faker->boolean(),
            'tags' => implode(',', $this->faker->words(rand(1, 4))),
        ];
    }
}
