<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guard>
 */
class GuardianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 10),
            'id_number' => $this->faker->unique()->numerify('####') . $this->faker->unique()->numerify('####') . $this->faker->unique()->numerify('####') . $this->faker->unique()->numerify('####'),
            'name' => $this->faker->name,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'relationship' => $this->faker->word,
            'job' => $this->faker->jobTitle,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'image' => null,
            'password' => bcrypt('password'),
        ];
    }
}
