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
    public function test_it_redirects_correctly(): void
{
    $response = $this->get('/');

    // On change 200 par 302 car ton middleware redirige
    $response->assertStatus(302);
    
    // Optionnel : vérifier la destination
    // $response->assertRedirect('/login');
}
}
