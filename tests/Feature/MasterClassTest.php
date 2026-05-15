<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\MasterClass;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MasterClassTest extends TestCase
{
    use RefreshDatabase;

    public function test_master_class_can_be_created(): void
    {
        $user = User::factory()->create();

        $category = Category::create([
            'name' => 'IT',
            'description' => 'IT category',
        ]);

        $masterClass = MasterClass::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Laravel Course',
            'description' => 'Laravel basics',
            'date' => '2026-01-01',
            'time' => '12:00',
            'max_people' => 10,
            'price' => 100,
        ]);

        $this->assertDatabaseHas('master_classes', [
            'title' => 'Laravel Course',
        ]);

        $this->assertNotNull($masterClass);
    }
}