<?php

namespace Tests\Feature;

use App\Models\Oeuvre;
use Database\Seeders\OeuvreSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class OeuvreTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_is_saved_in_a_cookie(): void
    {
        Oeuvre::factory()->create(['titre' => 'Death Note']);
        Oeuvre::factory()->create(['titre' => 'Naruto Uzumaki']);

        $this->get('/oeuvres?search=Death')->assertOk()
            ->assertSee('Death Note')->assertDontSee('Naruto Uzumaki')
            ->assertCookie('search', 'Death');
    }

    public function test_saved_search_is_used_when_the_query_is_missing(): void
    {
        Oeuvre::factory()->create(['titre' => 'Death Note']);
        Oeuvre::factory()->create(['titre' => 'Naruto Uzumaki']);

        $this->withCookie('search', 'Death')->get('/oeuvres')->assertOk()
            ->assertSee('Death Note')->assertDontSee('Naruto Uzumaki');
    }

    public function test_query_overrides_saved_search_and_empty_query_resets_it(): void
    {
        Oeuvre::factory()->create(['titre' => 'Death Note']);
        Oeuvre::factory()->create(['titre' => 'Naruto Uzumaki']);

        $this->withCookie('search', 'Death')->get('/oeuvres?search=Naruto Uzumaki')
            ->assertOk()->assertSee('Naruto Uzumaki')->assertDontSee('Death Note')
            ->assertCookie('search', 'Naruto Uzumaki');

        $this->get('/oeuvres?search=')->assertOk()
            ->assertSee('Death Note')->assertSee('Naruto Uzumaki')->assertCookie('search', '');
    }

    public function test_zero_is_a_valid_search(): void
    {
        Oeuvre::factory()->create(['titre' => 'Mob Psycho 100']);
        Oeuvre::factory()->create(['titre' => 'Naruto Uzumaki']);

        $this->get('/oeuvres?search=0')->assertOk()
            ->assertSee('Mob Psycho 100')->assertDontSee('Naruto Uzumaki');
    }

    public function test_array_search_is_rejected(): void
    {
        $this->getJson('/oeuvres?search[]=Death')->assertUnprocessable()
            ->assertJsonValidationErrors('search');
    }

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

    public function test_pagination_keeps_the_search_restored_from_a_cookie(): void
    {
        Oeuvre::factory()->count(13)->create(['titre' => 'Death Note']);

        $this->withCookie('search', 'Death')->get('/oeuvres')->assertOk()
            ->assertSee('page=2')->assertSee('search=Death');
    }

    #[TestWith([0.0])]
    #[TestWith([5.0])]
    public function test_note_boundaries_are_saved_as_floats(float $note): void
    {
        $oeuvre = Oeuvre::factory()->create(['note' => $note]);

        $this->assertSame($note, $oeuvre->fresh()->note);
    }

    public function test_seeder_inserts_examples_and_factory_records(): void
    {
        $this->seed(OeuvreSeeder::class);

        $this->assertDatabaseHas('oeuvres', ['titre' => 'Death Note']);
        $this->assertDatabaseCount('oeuvres', 32);
    }
}
