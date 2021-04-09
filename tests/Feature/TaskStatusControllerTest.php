<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Seeders\TaskStatusSeeder;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    //use WithoutMiddleware;
    use RefreshDatabase;

    public $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(TaskStatusSeeder::class);
        $this->user = User::first();
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertForbidden();
        // with authentication
        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $response = $this->get(route('task_statuses.edit', TaskStatus::first()->id));
        $response->assertForbidden();
        // with authentication
        $response = $this->actingAs($this->user)->get(route('task_statuses.edit', TaskStatus::first()->id));
        $response->assertOk();
    }

    public function testStore()
    {
        $this->withoutMiddleware();
        $data = ["name" => "test"];
        $response = $this->post(route('task_statuses.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertForbidden();
        $this->assertDatabaseMissing('task_statuses', $data);
        // with authentication
        $response = $this->actingAs($this->user)->post(route('task_statuses.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testUpdate()
    {
        $this->withoutMiddleware();
        $status = TaskStatus::first();
        $data = ['name' => 'test'];
        $response = $this->patch(route('task_statuses.update', $status->id), $data);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(419);
        $this->assertDatabaseMissing('task_statuses', $data);
        // with authentication
        $response = $this->actingAs($this->user)->patch(route('task_statuses.update', $status), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy()
    {
        $this->withoutMiddleware();
        $status = TaskStatus::first();
        $data = ["name" => $status->name, 'id' => $status->id];
        $response = $this->delete(route('task_statuses.destroy', $status->id));
        $response->assertSessionHasNoErrors();
        $response->assertStatus(419);
        $this->assertDatabaseHas('task_statuses', $data);
        // with authentication
        $response = $this->actingAs($this->user)->delete(route('task_statuses.destroy', $status->id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        //$this->assertDatabaseMissing('task_statuses', $status->toArray());
    }
}
