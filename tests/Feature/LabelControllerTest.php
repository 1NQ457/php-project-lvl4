<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Label;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Database\Seeders\LabelSeeder;
use Database\Seeders\UserSeeder;

class LabelControllerTest extends TestCase
{
    use WithFaker;

    private Label $label;
    private User $user;
    private array $newlabelAttributes;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(LabelSeeder::class);
        $this->seed(UserSeeder::class);
        $this->label = Label::findOrFail(1);
        $this->user = User::findOrFail(1);
        $this->newlabelAttributes = Label::factory()->make()->only(['name', 'description']);
    }

    public function testIndex(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('labels.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $this->withoutMiddleware('App\Http\Middleware\VerifyCsrfToken');
        $response = $this->actingAs($this->user)
            ->post(route('labels.store'), $this->newlabelAttributes);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', $this->newlabelAttributes);
        $response->assertRedirect();
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('labels.edit', $this->label));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $this->withoutMiddleware('App\Http\Middleware\VerifyCsrfToken');
        $response = $this->actingAs($this->user)
            ->patch(
                route('labels.update', $this->label),
                $this->newlabelAttributes
            );
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('labels', $this->label->only(['name', 'description']));
        $this->assertDatabaseHas('labels', $this->newlabelAttributes);
        $response->assertRedirect();
    }

    public function testDestroy(): void
    {
        $this->withoutMiddleware('App\Http\Middleware\VerifyCsrfToken');
        $response = $this->actingAs($this->user)
            ->delete(route('labels.destroy', $this->label));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('labels', $this->label->only(['name', 'description']));
        $response->assertRedirect();
    }
}
