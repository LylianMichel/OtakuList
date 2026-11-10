<?php

namespace Tests\Feature;

use App\Models\Oeuvre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogueTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalogue_displays_database_fields_and_missing_cover(): void
    {
        Oeuvre::factory()->create(['titre' => 'Mon aventure', 'type' => 'manga', 'status' => 'termine', 'image' => null, 'note' => 4.5, 'nb_episodes_tomes' => 12]);
        $this->get('/oeuvres')->assertOk()->assertSee('Mon aventure')->assertSee('4,5')->assertSee('12 tomes')->assertSee('Terminé')->assertSee('cover-placeholder');
    }

    public function test_search_type_and_status_filters_are_combined(): void
    {
        Oeuvre::factory()->create(['titre' => 'Sakura retenu', 'type' => 'manga', 'status' => 'termine']);
        Oeuvre::factory()->create(['titre' => 'Sakura anime exclu', 'type' => 'anime', 'status' => 'termine']);
        Oeuvre::factory()->create(['titre' => 'Sakura en cours exclu', 'type' => 'manga', 'status' => 'en_cours']);
        $this->get('/oeuvres?search=Sakura&type=manga&status=termine')->assertOk()->assertSee('Sakura retenu')->assertDontSee('Sakura anime exclu')->assertDontSee('Sakura en cours exclu');
    }

    public function test_anime_option_is_selectable_in_the_type_filter(): void
    {
        $this->get('/oeuvres?type=anime')->assertOk()
            ->assertSee('<option value="anime" selected>Animés</option>', false);
    }

    public function test_empty_search_explains_how_to_reset_filters(): void
    {
        $this->get('/oeuvres?search=introuvable')->assertOk()->assertSee('Aucune œuvre trouvée')->assertSee('Réinitialiser');
    }

    public function test_invalid_filters_are_rejected(): void
    {
        $this->getJson('/oeuvres?type=film')->assertUnprocessable()->assertJsonValidationErrors('type');
    }

    public function test_pagination_keeps_filters(): void
    {
        Oeuvre::factory()->count(13)->create(['type' => 'manga']);
        $this->get('/oeuvres?type=manga')->assertOk()->assertSee('page=2')->assertSee('type=manga');
    }

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

    public function test_query_overrides_saved_search(): void
    {
        Oeuvre::factory()->create(['titre' => 'Death Note']);
        Oeuvre::factory()->create(['titre' => 'Naruto Uzumaki']);

        $this->withCookie('search', 'Death')->get('/oeuvres?search=Naruto Uzumaki')
            ->assertOk()->assertSee('Naruto Uzumaki')->assertDontSee('Death Note')
            ->assertCookie('search', 'Naruto Uzumaki');
    }

    public function test_empty_query_resets_saved_search(): void
    {
        Oeuvre::factory()->create(['titre' => 'Death Note']);
        Oeuvre::factory()->create(['titre' => 'Naruto Uzumaki']);

        $this->withCookie('search', 'Death')->get('/oeuvres?search=')->assertOk()
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

    public function test_pagination_keeps_the_search_restored_from_a_cookie(): void
    {
        Oeuvre::factory()->count(13)->create(['titre' => 'Death Note']);

        $this->withCookie('search', 'Death')->get('/oeuvres')->assertOk()
            ->assertSee('page=2')->assertSee('search=Death');
    }

    public function test_pagination_keeps_zero_search(): void
    {
        Oeuvre::factory()->count(13)->create(['titre' => 'Mob Psycho 100']);

        $this->get('/oeuvres?search=0')->assertOk()
            ->assertSee('page=2')->assertSee('search=0');
    }
}
