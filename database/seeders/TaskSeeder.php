<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $labels = Label::all();
        $data = TaskStatus::all()->map(function ($item) {
            return ['status_id' => $item->id];
        })->all();

        Task::factory()->count(5)->state(new Sequence(...$data))->create()
            ->each(function (Task $task) use ($labels): void {
                $task->labels()->attach($labels->random(rand(1, 5)));
            });
    }
}
