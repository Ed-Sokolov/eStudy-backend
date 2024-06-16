<?php

namespace Tests\Feature;

use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreateTestRoom extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_room(): void
    {
        $this->actingAs(Auth::loginUsingId(1));

        $data = [
            'name' => 'Test Room',
            'students' => [
                5,
                6
            ]
        ];

        $response = $this->postJson('/api/rooms', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('rooms', [
            'name' => 'Test Room',
        ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'author' => [
                    'id',
                    'name',
                    'email'
                ],
            ]
        ]);
    }

    public function test_update_room(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $room = Room::factory()->create();

        $updateData = [
            'name' => 'Updated Room name',
            'students' => [
                4
            ]
        ];

        $response = $this->putJson("/api/rooms/{$room->id}", $updateData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('rooms', [
            'id' => $room->id,
            'name' => 'Updated Room name',
        ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',

                'author' => [
                    'id',
                    'name',
                    'email'
                ],
            ]
        ]);
    }

    public function test_delete_room(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $room = Room::factory()->create();

        $response = $this->deleteJson("/api/rooms/{$room->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('rooms', ['id' => $room->id]);
    }
}
