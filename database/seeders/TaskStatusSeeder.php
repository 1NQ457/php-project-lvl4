<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();
        $user->save();

        $statuses = [
            'новый',
            'в работе',
            'на тестировании',
            'завершен',
        ];
        foreach ($statuses as $statusValue) {
            $status = $user->taskStatuses()->make(['name' => $statusValue]);
            $status->save();
        }
    }
}
