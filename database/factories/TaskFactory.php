<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\TaskStatus;
use App\Models\User;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = TaskStatus::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        $executor = User::inRandomOrder()->first();

        return [
            'name' => $this->faker->name,
            'status_id' => $status->id,
            'description' => Str::random(10),
            'created_by_id' => $user->id,
            'assigned_to_id' => $executor->id,
        ];
    }
}
