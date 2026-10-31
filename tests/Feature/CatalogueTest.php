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
}
