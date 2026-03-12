<?php

namespace Cervon\Tms\Dto\TaskTemplate;

class RequiredOptions
{
    public function __construct(
        public ?string $type,
        public ?float $quantity,
        public ?array $options,
        public ?bool $mandatory,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            type: $data['type'] ?? null,
            quantity: $data['quantity'] ?? null,
            options: $data['options'] ?? null,
            mandatory: $data['mandatory'] ?? null,
        );
    }
}
