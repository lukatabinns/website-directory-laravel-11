<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Website;
use App\Models\Category;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function testSearchWebsitesByTitle()
    {
        Website::factory()->create(['title' => 'Earum cumque qui vel aut.']);
        Website::factory()->create(['title' => 'Exercitationem architecto culpa sit quas nisi.']);

        $response = $this->getJson('/api/websites/search?search=Earum');

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Earum cumque qui vel aut.'])
                 ->assertJsonMissing(['title' => 'Exercitationem architecto culpa sit quas nisi.']);
    }

    public function testSearchWebsitesByCategory()
    {
        $category = Category::factory()->create(['name' => 'explicabo']);
        $website = Website::factory()->create();
        $website->categories()->attach($category->id);

        Website::factory()->create();

        $response = $this->getJson('/api/websites/search?category=explicabo');

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => $website->title]);
    }
}
