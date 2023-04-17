<?php

namespace Database\Factories;

use App\Models\Project;
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
        $projectIds = Project::all()->pluck('id');

        return [
            'project_id' => $this->faker->randomElement($projectIds),
            'name'       => $this->faker->word(),
            'priority'   => $this->faker->numberBetween(1, 5),
        ];
    }
}
