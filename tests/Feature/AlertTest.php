<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Blade;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class AlertTest extends TestCase
{
    #[TestWith(['success'])]
    #[TestWith(['error'])]
    #[TestWith(['warning'])]
    #[TestWith(['info'])]
    public function test_alert_displays_its_type_title_and_escaped_message(string $type): void
    {
        $html = Blade::render('<x-alert :type="$type" title="Un message" id="example">{{ $message }}</x-alert>', [
            'type' => $type,
            'message' => '<script>alert("test")</script>',
        ]);

        $this->assertStringContainsString('alert-'.$type, $html);
        $this->assertStringContainsString('Un message', $html);
        $this->assertStringContainsString('id="example"', $html);
        $this->assertStringContainsString('&lt;script&gt;', $html);
        $this->assertStringNotContainsString('<script>', $html);
    }

    public function test_alert_can_be_dismissed(): void
    {
        $html = Blade::render('<x-alert type="success" dismissible>Message</x-alert>');

        $this->assertStringContainsString('x-show="show"', $html);
        $this->assertStringContainsString('show = false', $html);
        $this->assertStringContainsString('fa-circle-check', $html);
        $this->assertStringContainsString('Fermer le message', $html);
    }

    #[TestWith(['success'])]
    #[TestWith(['error'])]
    #[TestWith(['warning'])]
    #[TestWith(['info'])]
    public function test_flash_messages_are_displayed_in_both_layouts(string $type): void
    {
        foreach (['/', '/forgot-password'] as $path) {
            $this->withSession([$type => 'Message de test'])->get($path)
                ->assertOk()->assertSee('Message de test')->assertSee('alert-'.$type)->assertSee('Fermer le message');
        }
    }
}
