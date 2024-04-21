<?php

namespace Database\Seeders;

use App\Models\TaskStatusReference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TaskStatusReferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        TaskStatusReference::truncate();
        TaskStatusReference::create(
            [
                'slug' => Str::slug('To Do'),
                'name' => 'To Do',
            ]
        );
        TaskStatusReference::create(

            [
                'slug' => Str::slug('In Progress'),
                'name' => 'In Progress',
            ]
        );
        TaskStatusReference::create(
            [
                'slug' => Str::slug('Done'),
                'name' => 'Done',
            ]
        );
        Schema::enableForeignKeyConstraints();
    }
}
