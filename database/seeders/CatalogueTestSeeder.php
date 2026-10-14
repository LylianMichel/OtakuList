<?php

namespace Database\Seeders;

use App\Models\Oeuvre;
use Illuminate\Database\Seeder;

class CatalogueTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $oeuvres = [
            ['titre' => 'Naruto', 'synopsis' => 'Un jeune ninja rêve de devenir Hokage et de gagner la reconnaissance de son village.', 'annee' => 2002, 'status' => 'termine', 'nb_episodes_tomes' => 220, 'studio' => 'Studio Pierrot', 'note' => 4.5],
            ['titre' => 'Death Note', 'synopsis' => 'Light découvre un carnet capable de tuer et affronte le mystérieux détective L.', 'annee' => 2006, 'status' => 'termine', 'nb_episodes_tomes' => 37, 'studio' => 'Madhouse', 'note' => 4.7],
            ['titre' => 'Frieren', 'synopsis' => 'Une mage elfe repart en voyage pour comprendre les liens tissés avec ses compagnons humains.', 'annee' => 2023, 'status' => 'en_cours', 'nb_episodes_tomes' => 28, 'studio' => 'Madhouse', 'note' => 4.8],
        ];

        foreach ($oeuvres as $oeuvre) {
            Oeuvre::updateOrCreate(['titre' => $oeuvre['titre'], 'type' => 'anime'], [...$oeuvre, 'type' => 'anime', 'image' => null]);
        }
    }
}
