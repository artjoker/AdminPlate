<?php

namespace Tests\Feature\Backend;

use App\Models\Client;
use App\Models\User;
use Tests\TestCase;

/**
 * Class ClientTest.
 */
class ClientTest extends TestCase
{
    public function testShow()
    {
        $this->withoutMiddleware()->actingAs(User::whereName('Admin')->first())->get(
            route('backend.clients.show', ['client' => Client::factory()->create()])
        )->assertOk();
    }
}
