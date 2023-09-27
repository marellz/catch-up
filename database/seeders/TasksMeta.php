<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\task\TaskStatus;
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
            'pending',
            'in_progress',
            'complete',
        ];

        $categories = [
            'home',
            'work',
            'urgent',
            'important',
        ];


        foreach ($categories as $category) {
            Category::create(['name'=>$category]);
        }

        foreach ($statuses as $status) {
            TaskStatus::create([
                'name'=>$status,
            ]);
        }
    }
}
