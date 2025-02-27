<?php

namespace Tests\Unit;

use App\Models\Tabulka;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TabulkaTest extends TestCase
{
    use RefreshDatabase;

           #[Test]
    public function úloha_môže_byť_vytvorená()
    {
        $data = [
            'name' => 'Test Úloha',
            'description' => 'Testovací popis úlohy',
            'status' => 1,
            'tags' => 'test,úloha'
        ];

        $tabulka = Tabulka::create($data);

        $this->assertDatabaseHas('tabulkas', $data);
        $this->assertEquals('Test Úloha', $tabulka->name);
    }

           #[Test]
    public function úloha_môže_byť_upravená()
    {
        $tabulka = Tabulka::factory()->create([
            'name' => 'Pôvodná Úloha',
            'description' => 'Pôvodný popis',
            'status' => 0,
            'tags' => 'povodny'
        ]);

        $updatedData = [
            'name' => 'Upravená Úloha',
            'description' => 'Upravený popis',
            'status' => 1,
            'tags' => 'upraveny'
        ];

        $tabulka->update($updatedData);

        $this->assertDatabaseHas('tabulkas', $updatedData);
        $this->assertEquals('Upravená Úloha', $tabulka->name);
    }

           #[Test]
    public function úloha_môže_byť_odstránená()
    {
        $tabulka = Tabulka::factory()->create();

        $tabulka->delete();

        $this->assertDatabaseMissing('tabulkas', ['id' => $tabulka->id]);
    }
}