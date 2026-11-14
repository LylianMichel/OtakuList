<?php

namespace App\View\Components\Partials;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public const TYPES = [
        'success' => 'fa-circle-check',
        'error' => 'fa-circle-xmark',
        'warning' => 'fa-triangle-exclamation',
        'info' => 'fa-circle-info',
    ];

    public function __construct(
        public string $type = 'info',
        public ?string $title = null,
        public bool $dismissible = false,
    ) {
        if (! array_key_exists($this->type, self::TYPES)) {
            $this->type = 'info';
        }
    }

    public function render(): View
    {
        return view('components.partials.alert', ['icon' => self::TYPES[$this->type]]);
    }
}
