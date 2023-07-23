<?php

namespace Tests\Feature\Frontend;

use App\Models\Client;
use Database\Seeders\ClientsSeeder;
use Tests\TestCase;

/**
 * Class AuthTest.
 */
class AuthTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // Seed feedbacks
        $this->seed(ClientsSeeder::class);
    }

    public function testNonAuthProfile()
    {
        $this->get(route('profile'))->assertRedirect(route('login'));
    }

    public function testProfile()
    {
        $client = Client::first();
        $this->actingAs($client, 'web')->get(route('profile'))->assertStatus(200);
    }

    public function testLogin()
    {
        $client           = Client::whereEmail('user@example.com')->first();
        $client->email    = 'user@example.com';
        $client->password = bcrypt('secret');
        $client->save();

        $this->withoutMiddleware();
        $this->post(route('login'), [
            'email'    => 'user@example.com',
            'password' => 'secret',
        ]);
        $this->assertAuthenticatedAs($client, 'web');
    }

    public function testLogout()
    {
        $this->withoutMiddleware();
        $this->post(route('login'), [
            'email'    => 'user1234@example.com',
            'password' => 'secret',
        ]);

        $this->get(route('logout'));
        $this->get(route('home'))->assertOk();
    }
}
