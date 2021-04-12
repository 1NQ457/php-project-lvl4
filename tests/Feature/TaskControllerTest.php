<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskStatus;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    private Task $task;
    private User $taskCreator;
    private TaskStatus $taskStatus;
    private array $newTaskAttributes;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->task = Task::findOrFail(1);
        $this->taskCreator = optional($this->task)->creator;
        $this->taskStatus = TaskStatus::findOrFail(1);
        $this->newTaskAttributes = Task::factory()->make([
            'status_id' => optional($this->taskStatus)->id,
        ])->only(['name', 'description', 'status_id']);
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->taskCreator)
            ->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $this->withoutMiddleware('App\Http\Middleware\VerifyCsrfToken');
        $response = $this->actingAs($this->taskCreator)->post(
            route('tasks.store'),
            $this->newTaskAttributes
        );
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $this->newTaskAttributes);
        $response->assertRedirect();
    }

    public function testShow(): void
    {
        $response = $this->actingAs($this->taskCreator)
            ->get(route('tasks.show', $this->task));
        $response->assertOk();
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->taskCreator)
            ->get(route('tasks.edit', $this->task));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $this->withoutMiddleware('App\Http\Middleware\VerifyCsrfToken');
        $response = $this->actingAs($this->taskCreator)
            ->patch(
                route('tasks.update', $this->task),
                $this->newTaskAttributes
            );
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('tasks', $this->task->only(['id', 'name', 'description', 'status_id']));
        $this->assertDatabaseHas('tasks', $this->newTaskAttributes);
        $response->assertRedirect();
    }

    public function testDestroy(): void
    {
        $this->withoutMiddleware('App\Http\Middleware\VerifyCsrfToken');
        $response = $this->actingAs($this->taskCreator)
            ->delete(route('tasks.destroy', $this->task));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('tasks', $this->task->only(['id', 'name', 'description', 'status_id']));
        $response->assertRedirect();
    }
}
