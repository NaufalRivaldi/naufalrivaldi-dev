<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug(2),
            'title' => fake()->words(3, true),
            'subtitle' => fake()->sentence(),
            'overview' => fake()->paragraph(),
            'best_for' => fake()->sentence(),
            'engagement_duration' => '4–12 weeks',
            'icon' => fake()->randomElement(['code', 'server', 'phone', 'db']),
            'deliverables' => [fake()->sentence(), fake()->sentence()],
            'process' => [
                ['title' => 'Discovery', 'description' => fake()->sentence()],
                ['title' => 'Build', 'description' => fake()->sentence()],
            ],
            'tech_stack' => ['Laravel', 'PHP'],
            'is_featured' => false,
            'sort_order' => fake()->numberBetween(1, 99),
        ];
    }

    public function featured(): static
    {
        return $this->state(['is_featured' => true]);
    }
}
