<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Priority;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::pluck('id')->toArray();
        $priorities = Priority::pluck('id')->toArray();

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'user_id' => $this->faker->numberBetween(1, 10), // Assuming you have users
            'status' => $this->faker->randomElement(['open', 'closed']),
            'category_id' => $this->faker->randomElement($categories),
            'priority_id' => $this->faker->randomElement($priorities),
        ];
    }
}
