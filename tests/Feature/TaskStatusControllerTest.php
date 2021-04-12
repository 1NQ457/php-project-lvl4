<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\TaskStatus;
use Database\Seeders\TaskStatusSeeder;
use Database\Seeders\UserSeeder;

class TaskStatusControllerTest extends TestCase
{
    private User $user;
    private TaskStatus $taskStatus;
    private string $newTaskStatusName;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(TaskStatusSeeder::class);
        $this->seed(UserSeeder::class);
        $this->user = User::findOrFail(1);
        $this->taskStatus = TaskStatus::findOrFail(1);
        $this->newTaskStatusName = 'test';
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }


    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $this->withoutMiddleware();
        $response = $this->actingAs($this->user)
        ->post(route('task_statuses.store'), ['name' => $this->newTaskStatusName]);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', $this->taskStatus->only(['name']));
        $response->assertRedirect();
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.edit', $this->taskStatus));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $this->withoutMiddleware();
        $taskStatus = TaskStatus::find(1);
        $oldName = "Новый";
        $testName = "test name";
        $response = $this->actingAs($this->user)
            ->patch(route('task_statuses.update', $taskStatus), [
                'name' => $testName,
            ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('task_statuses', ['name' => $oldName]);
        $this->assertDatabaseHas('task_statuses', [
            'name' => $testName,
        ]);
    }

    public function testDestroy(): void
    {
        $this->withoutMiddleware('App\Http\Middleware\VerifyCsrfToken');
        $taskStatus = TaskStatus::find(2);
        $response = $this->actingAs($this->user)
            ->delete(route('task_statuses.destroy', $taskStatus));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('task_statuses', ['id' => $taskStatus->id]);
    }
}
