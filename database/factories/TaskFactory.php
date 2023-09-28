<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $complete = $this->faker->boolean();
        return [
            //
            "name" => $this->faker->name(),
            "description" => $this->faker->sentence(),
            "duration" => $this->faker->numberBetween(1, 9) * 10,
            "due_date" => now()->addHours($this->faker->randomNumber(1,24)),
            "status_id" => $complete ? 3 : $this->faker->numberBetween(1,2),
        ];
    }
}
