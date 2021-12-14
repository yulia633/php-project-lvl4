<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['новый', 'в работе', 'на тестировании', 'завершен'];

        foreach ($statuses as $status) {
            $newStatus = new TaskStatus();
            $newStatus->fill(['name' => $status]);
            $newStatus->save();
        }
    }
}
