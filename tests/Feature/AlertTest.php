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
}
