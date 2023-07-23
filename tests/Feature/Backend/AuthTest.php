<?php

namespace Tests\Feature\Backend;

use App\Models\User;
use Tests\TestCase;

/**
 * Class AuthTest.
 */
class AuthTest extends TestCase
{
    public function testLogin(): void
    {
        /** @var User $client */
        $client = User::whereEmail('admin@example.com')->first();

        $client->email    = 'admin@example.com';
        $client->password = bcrypt('secret');
        $client->save();

        $this->withoutMiddleware();
        $this->post(route('backend.login'), [
            'email'    => 'admin@example.com',
            'password' => 'secret',
        ]);
        $this->assertAuthenticatedAs($client, 'admin');
    }

    public function testLogout(): void
    {
        $this->withoutMiddleware();
        $this->post(route('backend.login'), [
            'email'    => 'admin@example.com',
            'password' => 'secret',
        ]);

        $this->get(route('backend.logout'));
        $this->get(route('home'))->assertOk();
    }
}
