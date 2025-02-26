<?php

namespace Database\Seeders;

use App\Models\Tabulka;
use Illuminate\Database\Seeder;

class TabulkaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tabulka::factory()->count(20)->create();
    }
}
