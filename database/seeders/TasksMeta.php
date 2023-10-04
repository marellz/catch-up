<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TasksMeta extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $statuses = [
            'Pending',
            'In progress',
            'Complete',
        ];

        $categories = [
            'home',
            'work',
            'urgent',
            'important',
        ];

        $actionables = [
            'Complete assignment',
            'Make dinner',
            'Do dishes',
            'Pet the cat',
            'Clean up my room',
            'Fetch some groceries',
            'Take out trash',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        foreach ($statuses as $status) {
            TaskStatus::create([
                'name' => $status,
            ]);
        }

        foreach ($actionables as $action) {
            $id = User::inRandomOrder()->first()->id;
            Task::factory()->create([
                'name' => $action,
                'user_id' => $id,
            ]);
        }
    }
}
