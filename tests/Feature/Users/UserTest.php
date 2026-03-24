<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    #[Test]
    public function test_index_returns_users_with_relations(): void
    {
        $response = $this->actingAs($this->admin)
            ->getJson('/api/users');

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'email',
                        'posts',
                        'role',
                        'created_at',
                        'comments',
                        'pages',
                        'posts'
                    ]
                ]
            ]);

        $usersCollection = $response->original;
        $this->assertTrue($usersCollection->first()->relationLoaded('posts'), 'Posts relation not loaded');
        $this->assertTrue($usersCollection->first()->relationLoaded('comments'), 'Comments relation not loaded');
        $this->assertTrue($usersCollection->first()->relationLoaded('pages'), 'Pages relation not loaded');
    }

    #[Test]
    public function test_index_unauthorized_returns_403(): void
    {
        $this->getJson('/api/users')
            ->assertUnauthorized();
    }
}
