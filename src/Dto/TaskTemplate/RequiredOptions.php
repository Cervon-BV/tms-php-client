<?php

namespace Cervon\Tms\Dto\TaskTemplate;

class RequiredOptions
{
    public function __construct(
        public bool $mandatory,
        public string $type,
        public float $quantity,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            mandatory: $data['mandatory'],
            type: $data['type'],
            quantity: $data['quantity'],
        );
    }
}
