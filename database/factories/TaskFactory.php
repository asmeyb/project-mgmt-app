<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
        $user = User::factory()->create();
        return [
            'name' => $this->faker->sentence(4),
            'description' => $this->faker->optional()->paragraph(),
            'image_path' => $this->faker->optional()->imageUrl(640, 480, 'abstract'),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed', 'cancelled','on_hold']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'due_date' => $this->faker->optional()->dateTimeBetween('now', '+3 months'),
            'assigned_user_id' => $this->faker->optional()->randomElement([User::factory(), null]),
            'project_id' => Project::factory(),
            'category_id' => Category::factory(),
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ];
    }
}