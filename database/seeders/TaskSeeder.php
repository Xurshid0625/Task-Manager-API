<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        Task::create([
            'user_id' => $user->id,
            'title' => 'Birinchi vazifa',
            'description' => 'Bu birinchi test vazifa',
            'status' => 'Alo',
        ]);

        Task::create([
            'user_id' => $user->id,
            'title' => 'Ikkinchi vazifa',
            'description' => 'Bu Ikkinchi test vazifa',
            'status' => 'Yaxshi',
        ]);
    }
}
