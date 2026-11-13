<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class StaticPageTest extends TestCase
{
    #[TestWith(['/'])]
    #[TestWith(['/a-propos'])]
    #[TestWith(['/contact'])]
    public function test_static_pages_share_the_navigation_and_footer(string $path): void
    {
        $this->get($path)->assertOk()->assertSee('Navigation principale')
            ->assertSee('OtakuList · Animés & mangas', false)
            ->assertSee(route('oeuvres.index'), false);
    }
}
