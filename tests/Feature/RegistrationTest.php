<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\MasterClass;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_can_be_created(): void
    {
        $user = User::factory()->create();

        $category = Category::create([
            'name' => 'IT',
            'description' => 'IT category',
        ]);

        $masterClass = MasterClass::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Laravel',
            'description' => 'Laravel course',
            'date' => '2026-01-01',
            'time' => '12:00',
            'max_people' => 10,
            'price' => 100,
        ]);

        $registration = Registration::create([
            'user_id' => $user->id,
            'master_class_id' => $masterClass->id,
        ]);

        $this->assertDatabaseHas('registrations', [
            'user_id' => $user->id,
        ]);

        $this->assertNotNull($registration);
    }
}