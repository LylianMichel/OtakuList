<?php

namespace Database\Factories;

use App\Models\Oeuvre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Oeuvre>
 */
class OeuvreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = $this->faker->dateTimeInInterval('-6 months', '+180 days');
        return [
            'titre' => $this->faker->sentence(6, false),
            'synopsis' => $this->faker->sentence(20, false),
            'type' => $this->faker->randomElement(['anime', 'manga']),
            'annee' => $this->faker->numberBetween(1980, 2025),
            'status' => $this->faker->randomElement(['en_cours', 'termine', 'a_venir']),
            'nb_episodes_tomes' => $this->faker->numberBetween(1, 100),
            'studio' => $this->faker->sentence(3, false),
            'image' => $this->faker->sentence(10, false),
            'note' => $this->faker->randomFloat(1, 0, 5),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }


}
