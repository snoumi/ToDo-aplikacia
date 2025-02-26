<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\TabulkaSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();

        $this->call(TabulkaSeeder::class);
    }
}
