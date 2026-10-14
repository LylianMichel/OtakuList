<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Oeuvre;
use Illuminate\Support\Facades\File;

class OeuvreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('seeders/data/oeuvres.json'));
        $oeuvres = json_decode($json, true);
        foreach ($oeuvres as $oeuvre) {
            Oeuvre::create($oeuvre);
        }

        Oeuvre::factory()->count(5)->create();
    }
}
