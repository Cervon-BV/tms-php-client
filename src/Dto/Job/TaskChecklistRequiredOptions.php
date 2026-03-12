<?php

namespace Cervon\Tms\Dto\Job;

class TaskChecklistRequiredOptions
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

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
