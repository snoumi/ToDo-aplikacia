<?php

namespace Database\Seeders;

use App\Models\Tabulka;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(20)->create();
        Tabulka::factory()->count(20)->create();
    }
}
