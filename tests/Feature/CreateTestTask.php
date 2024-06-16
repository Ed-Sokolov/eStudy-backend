<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreateTestTask extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_task(): void
    {
        $this->actingAs(Auth::loginUsingId(1));

        $data = [
            'name' => 'Test Task',
            'description' => 'Something text from testing',
            'room_id' => 1,
            'author_id' => 1,
            'status_id' => 1,
            'type_id' => 1,
        ];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('tasks', [
            'name' => 'Test Task',
        ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'date',
                'author' => [
                    'id',
                    'name',
                    'email'
                ],
                'room' => [
                    'id',
                    'name',
                ],
                'type' => [
                    'id',
                    'name',
                ],
                'status' => [
                    'id',
                    'name',
                ],
            ]
        ]);
    }

    public function test_update_task(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create();

        $updateData = [
            'name' => 'Updated Task',
            'description' => 'Updated description',
            'status_id' => 2,
            'room_id' => 1,
            'author_id' => 1,
            'type_id' => 2,
        ];

        $response = $this->putJson("/api/tasks/{$task->id}", $updateData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => 'Updated Task',
            'description' => 'Updated description',
            'status_id' => 2,
        ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'date',

                'author' => [
                    'id',
                    'name',
                    'email'
                ],
                'room' => [
                    'id',
                    'name',
                ],
                'type' => [
                    'id',
                    'name',
                ],
                'status' => [
                    'id',
                    'name',
                ],
            ]
        ]);
    }

    public function test_delete_task(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
