<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

/**
 * Class ClientsSeeder.
 */
class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Client::factory()->createOne([
            'first_name' => 'User',
            'password'   => bcrypt('secret'),
            'email'      => 'user@example.com',
            'active'     => true,
        ]);
    }
}
