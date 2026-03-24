<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
    public function test_authenticated_user_can_see_home()
    {
        // Crée un utilisateur fictif en base de données
        $user = \App\Models\User::factory()->create();
    
        // Agit en tant que cet utilisateur
        $response = $this->actingAs($user)->get('/');
    
        $response->assertStatus(200);
    }
    
}
