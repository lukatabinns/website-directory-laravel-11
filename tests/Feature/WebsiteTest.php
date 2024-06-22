<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Website;
use App\Models\Category;
use App\Models\User;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        return $user;
    }

    public function testListWebsites()
    {
        Website::factory()->count(5)->create();

        $response = $this->getJson('/api/websites');

        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data');
    }

    public function testAddAWebsite()
    {
        $user = $this->authenticate();

        $category = Category::factory()->create();

        $response = $this->postJson('/api/websites', [
            'url' => 'https://example.com',
            'title' => 'Example',
            'description' => 'Example Description',
            'categories' => [$category->id],
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['url' => 'https://example.com']);
    }

    public function testVoteForAWebsite()
    {
        $user = $this->authenticate();

        $website = Website::factory()->create();

        $response = $this->postJson("/api/websites/{$website->id}/vote");

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Vote recorded']);

        $this->assertDatabaseHas('votes', [
            'user_id' => $user->id,
            'website_id' => $website->id,
        ]);
    }

    public function testDeleteAWebsiteAsAdmin()
    {
        $user = $this->authenticate();
        $user->is_admin = true;
        $user->save();

        $website = Website::factory()->create();

        $response = $this->deleteJson("/api/websites/{$website->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('websites', ['id' => $website->id]);
    }
}
