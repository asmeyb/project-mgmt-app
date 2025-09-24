<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        $startDate = $this->faker->dateTimeBetween('-6 months', 'now');
        $endDate = $this->faker->dateTimeBetween($startDate, '+1 year');
        
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'image_path' => $this->faker->optional()->imageUrl(640, 480, 'business'),
            'status' => $this->faker->randomElement(['in_progress', 'pending','cancelled', 'completed', 'on_hold']),
            'created_by' => $user->id,
            'updated_by' => $user->id,
            'client_id' => Client::factory(),
            'category_id' => Category::factory(),
        ];
    }
}