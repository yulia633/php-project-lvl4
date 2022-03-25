<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use Illuminate\Support\Str;
use App\Models\TaskStatus;
use App\Models\User;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => Str::random(10),
            'status_id' => TaskStatus::inRandomOrder()->first(),
            'created_by_id' => User::inRandomOrder()->first(),
            'assigned_to_id' => User::inRandomOrder()->first(),

        ];
    }
}
