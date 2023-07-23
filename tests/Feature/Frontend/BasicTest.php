<?php

namespace Tests\Feature\Frontend;

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
        $this->get(route('home'))->assertOk();
        $this->get(route('login'))->assertOk();
        $this->get(route('register'))->assertOk();
    }
}
