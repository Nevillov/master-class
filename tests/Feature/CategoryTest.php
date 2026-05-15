<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_category_can_be_created(): void
    {
        $category = Category::create([
            'name' => 'Programming',
            'description' => 'Programming category',
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Programming',
        ]);

        $this->assertNotNull($category);
    }
}
