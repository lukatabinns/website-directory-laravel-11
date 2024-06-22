<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        return $user;
    }

    // Test the index method
    public function testIndex()
    {
        Category::factory()->count(3)->create();

        $response = $this->get('/api/categories');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    // Test the store method
    public function testStore()
    {
        $this->auth();

        $response = $this->post('/api/categories', [
            'name' => 'Test Category',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'name' => 'Test Category',
                 ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
        ]);
    }

    // Test the show method
    public function testShow()
    {
        $category = Category::factory()->create();

        $response = $this->get("/api/categories/{$category->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'name' => $category->name,
                 ]);
    }

    // Test the update method
    public function testUpdate()
    {
        $this->auth();

        $category = Category::factory()->create();

        $response = $this->put("/api/categories/{$category->id}", [
            'name' => 'Updated Category',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'name' => 'Updated Category',
                 ]);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Category',
        ]);
    }

    // Test the destroy method
    public function testDestroy()
    {
        $this->auth();

        $category = Category::factory()->create();

        $response = $this->delete("/api/categories/{$category->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }

    private function auth(){
        $user = $this->authenticate();
        $user->is_admin = true;
        $user->save();
    }
}
