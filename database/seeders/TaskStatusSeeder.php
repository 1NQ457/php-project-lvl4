<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaskStatus::factory()
            ->count(4)
            ->state(new Sequence(
                ['name' => 'новый'],
                ['name' => 'в работе'],
                ['name' => 'на тестировании'],
                ['name' => 'завершен']
            ))
            ->create();
    }
}
