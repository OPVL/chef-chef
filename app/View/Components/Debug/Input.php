<?php

namespace App\View\Components\Debug;

use Illuminate\View\Component;
use OutOfRangeException;

class Input extends Component
{
    protected $allowedTypes = [
        'text',
        'checkbox',
        'number',
        'email',
        'password',
    ];

    public function __construct(
        protected string $type,
        protected string $name,
        protected string $nonce,
        protected $value = null,
        protected ?string $placeholder = null,
        protected bool $required = false
    ) {
        throw_unless(
            array_search($type, $this->allowedTypes),
            new OutOfRangeException(
                "Type must be of: "
                    . implode(', ', $this->allowedTypes)
                    . ". Type supplied: {$type}"
            )
        );
    }

    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.debug.input', [
            'name' => $this->name,
            'type' => $this->type,
            'nonce' => $this->nonce,
        ]);
    }
}
