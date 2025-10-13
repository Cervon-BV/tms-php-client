<?php

namespace Cervon\Tms\Dto\Job;

class TaskChecklistRequiredOptions
{
    public function __construct(
        public string $type,
        public ?int $quantity,
        public bool $mandatory,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            type: $data['type'],
            quantity: $data['quantity'] ?? null,
            mandatory: $data['mandatory'] ?? true,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
