<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Todo;

class TodoTest extends TestCase
{
   use RefreshDatabase; //各テスト後にデータベースをリフレッシュ

    public function testCreateTodo()
    {
       
       $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
       
        $user = User::factory()->create();
        $this -> actingAs($user);
       
        $response = $this->post('/todos', [
            'content' => 'New Todo',
        ]);

        $response->assertRedirect('/todos'); //成功後のリダイレクト先
        $this->assertDatabaseHas('todos', [
            'content' => 'New Todo',
            'user_id' => $user->id,
        ]);
    }

    public function testStoreTodo()
    {
        $user=User::factory()->create();
        $this->actingAs($user);

        Todo::factory()->create([
            'user_id' => $user->id,
            'content' => 'My Todo'

        ]);

        $response = $this->get('/todos');
        $response -> assertSee('My Todo');
    }

    public function testUpdateTodo()
    {
        $user = User::factory()->create();
        $this -> actingAs($user);

        $todo = Todo::factory()->create([
            'user_id' => $user -> id,
            'content' => 'Old Content',
        ]);

        $response = $this->patch(
            route('todos.update', ['todo' => $todo -> id]),
        );

        $response -> assertRedirect('/');
        $this -> assertDatabaseHas('todos',[
            'id' => $todo -> id,
            'content' => 'Updated Content',
        ]);
    }

}