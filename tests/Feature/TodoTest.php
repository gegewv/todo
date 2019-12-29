<?php

namespace Tests\Feature;

use App\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{

    public function testExample()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function can_get_all_the_todos() {
        $todos = factory(Todo::class, 3)->create();

        $this->get('/todos')
        ->assertStatus(200)
        ->assertJson($todos->toArray());
    }

    /** @test */
    public function can_create_a_todo() {
        $todo = factory(Todo::class)->make()->toArray();

        $this->post('/todos', $todo)
            ->assertStatus(201)
            ->assertJson($todo);

        $this->assertDatabaseHas('todos', $todo);
    }

    /** @test */
    public function can_get_a_validation_error_when_trying_to_create_an_empty_todo() {
        $this->post('/todos', [])
            ->assertStatus(302);
    }
}
