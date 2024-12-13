<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Sample Task',
            'description' => 'Task description',
            'status' => 'pending',
            'assigned_to_user_id' => 1,  // Admin user
        ]);
        Task::create([
            'title' => 'Sample Task 2',
            'description' => 'Task description 2',
            'status' => 'completed',
            'assigned_to_user_id' => 1,  // Admin user
        ]);
        Task::create([
            'title' => 'Sample Task 3',
            'description' => 'Task description 3',
            'status' => 'in-progress',
            'assigned_to_user_id' => 1,  // Admin user
        ]);
    }
}
