<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PickupLog>
 */
class PickupLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'guardian_id' => $this->faker->numberBetween(1, 10),
            'student_id' => $this->faker->numberBetween(1, 10),
            'pickup_time' => now(),
        ];
    }
}
