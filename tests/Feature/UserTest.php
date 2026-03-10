<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_user(): void
    {
        $json = [
            'firstname' => 'Test',
            'lastname'  => 'Tester',
            'email'     => 'tester@test.com',
            'phone'     => '123456789012'
        ];

        $response = $this->postJson('/api/user', $json);

        $response->assertJsonFragment($json);
        $response->assertStatus(201);
        $this->assertDatabaseHas('users', $json);
    }

    public function test_post_user_should_return_422_when_missing_field(): void
    {
        $json = [
            'firstname' => 'Test',
            'email'     => 'tester@test.com',
            // lastname et phone manquants = 422
        ];

        $response = $this->postJson('/api/user', $json);

        $response->assertStatus(422);
    }

    public function test_update_user(): void
    {
        $user = User::factory()->create();

        $json = [
            'firstname' => 'Test',
            'lastname'  => 'Tester',
            'email'     => 'tester@test.com',
            'phone'     => '123456789012'
        ];

        $response = $this->postJson('/api/user/' . $user->id, $json);

        $response->assertJsonFragment($json);
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', $json);
    }

    public function test_update_user_should_return_404_when_id_not_found(): void
    {
        $json = [
            'firstname' => 'Test',
            'lastname'  => 'Tester',
            'email'     => 'tester@test.com',
            'phone'     => '123456789012'
        ];

        $response = $this->postJson('/api/user/424242', $json);

        $response->assertStatus(404);
    }

    public function test_update_user_should_return_422_when_missing_field(): void
{
    $user = User::factory()->create();

    $json = [
        'firstname' => 'Test',
        'email'     => 'tester@test.com',
        // lastname et phone manquants = 422
    ];

    $response = $this->postJson('/api/user/' . $user->id, $json);

    $response->assertStatus(422);
}
}
