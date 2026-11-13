<?php

namespace Tests\Feature;

use App\Models\Oeuvre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class OeuvreTest extends TestCase
{
    use RefreshDatabase;

    #[TestWith([-0.1])]
    #[TestWith([5.1])]
    #[TestWith(['invalide'])]
    #[TestWith([null])]
    public function test_invalid_notes_are_rejected(float|string|null $note): void
    {
        $oeuvre = Oeuvre::factory()->make(['note' => $note]);

        $this->expectException(ValidationException::class);

        $oeuvre->save();
    }

    public function test_note_validation_also_applies_to_updates(): void
    {
        $oeuvre = Oeuvre::factory()->create(['note' => 4.5]);

        $this->expectException(ValidationException::class);

        $oeuvre->update(['note' => 6]);
    }

    #[TestWith([0.0])]
    #[TestWith([5.0])]
    public function test_note_boundaries_are_saved_as_floats(float $note): void
    {
        $oeuvre = Oeuvre::factory()->create(['note' => $note]);

        $this->assertSame($note, $oeuvre->fresh()->note);
    }
}
