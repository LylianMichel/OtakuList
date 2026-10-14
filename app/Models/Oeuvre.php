<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oeuvre extends Model
{
    /** @use HasFactory<\Database\Factories\OeuvreFactory> */
    use HasFactory;
    protected $casts = [
        'note' => 'float',
    ];

    protected $fillable = [
        'titre',
        'type',
        'annee',
        'status',
        'nb_episodes_tomes',
        'studio',
        'image',
        'synopsis',
        'duree',
        'note',
    ];

}

//     Oeuvre::create([
//           'titre' => 'Titre de l\'oeuvre',
//           'type' => 'anime',
//           'annee' => 2024,
//           'status' => 'en_cours',
//           'nb_episodes_tomes' => 12,
//           'studio' => 'Studio',
//           'image' => 'image.jpg',
//           'synopsis' => 'Synopsis de l\'oeuvre',
//           'note' => 4.5,
//     ]);
// $table->check('rating >= 0 AND rating <= 5');
