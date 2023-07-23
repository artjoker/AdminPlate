<?php

namespace Tests\Feature\Backend;

use App\Models\User;
use Tests\TestCase;

/**
 * Class BasicTest.
 */
class BasicTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->get(route('backend.home'))->assertOk();
        $this->get(route('backend.login'))->assertOk();
        $this->withoutMiddleware()->actingAs(User::first());
        $this->get(route('backend.dashboard'))->assertOk();
        $this->get(route('backend.users.index'))->assertOk();
        $this->get(route('backend.roles.index'))->assertOk();
        $this->get(route('backend.permissions.index'))->assertOk();
        $this->get(route('backend.clients.index'))->assertOk();
    }
}
