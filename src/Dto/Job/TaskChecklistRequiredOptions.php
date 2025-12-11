<?php

namespace Cervon\Tms\Dto\Job;

class TaskChecklistRequiredOptions
{
    public function __construct(
        public bool $mandatory,
        public ?string $type,
        public ?float $quantity,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            mandatory: $data['mandatory'] ?? true,
            type: $data['type'] ?? null,
            quantity: $data['quantity'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
