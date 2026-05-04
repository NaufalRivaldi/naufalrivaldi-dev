<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug(2),
            'title' => fake()->words(3, true),
            'subtitle' => fake()->sentence(),
            'tag' => fake()->word(),
            'client' => fake()->company(),
            'role' => 'Fullstack Developer',
            'duration' => '4 months',
            'year' => (string) fake()->year(),
            'featured' => false,
            'challenge' => fake()->paragraph(),
            'solution' => fake()->paragraph(),
            'outcome' => [
                ['k' => 'Metric A', 'v' => '+20%'],
                ['k' => 'Metric B', 'v' => '-30%'],
            ],
            'tech' => ['Laravel', 'PHP'],
            'sort_order' => fake()->numberBetween(1, 99),
        ];
    }

    public function featured(): static
    {
        return $this->state(['featured' => true]);
    }
}
