<?php

namespace App\Models;

use Database\Factories\OeuvreFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Oeuvre extends Model
{
    /** @use HasFactory<OeuvreFactory> */
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
        'note',
    ];

    protected static function booted(): void
    {
        static::saving(function (Oeuvre $oeuvre): void {
            Validator::make(
                $oeuvre->getAttributes(),
                ['note' => ['required', 'numeric', 'between:0,5']],
                ['note.between' => 'La note doit être comprise entre 0 et 5.'],
            )->validate();
        });
    }
}
