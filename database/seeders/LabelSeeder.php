<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Label;
use Illuminate\Database\Eloquent\Factories\Sequence;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Label::factory()
            ->count(5)
            ->state(new Sequence(
                ['name' => 'bug', 'description' => 'Indicates an unexpected problem or unintended behavior'],
                ['name' => 'documentation', 'description' => 'Indicates a need for improvements or additions to documentation'],
                ['name' => 'duplicate', 'description' => '	Indicates similar issues or pull requests'],
                ['name' => 'enhancement', 'description' => 'Indicates new feature requests'],
                ['name' => 'good first issue', 'description' => 'Indicates a good issue for first-time contributors']
            ))
            ->create();
    }
}
