<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class HelloTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this -> assertTrue(true);

        $user = User::factory()->create(); //テストユーザーの作成
        $this->actingAs($user); //ログイン状態にする
        
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/no_route');
        $response -> assertStatus(404);
    }
}
