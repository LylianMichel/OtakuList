<?php

namespace Tests\Feature;

use Database\Seeders\OeuvreSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OeuvreSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_inserts_examples_and_factory_records(): void
    {
        $this->seed(OeuvreSeeder::class);

        $this->assertDatabaseHas('oeuvres', ['titre' => 'Death Note']);
        $this->assertDatabaseCount('oeuvres', 32);
    }
}
