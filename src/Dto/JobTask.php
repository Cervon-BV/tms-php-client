<?php

namespace Jacobtims\Tms\Dto;

class JobTask
{
    public function __construct(
        public string $tid,
        public string $type,
        public int $quantity,
        public string $description,
        public ?JobTaskItem $item,
        public ?bool $has_item,
        public ?int $quantity_remaining,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            tid: $data['tid'],
            type: $data['type'],
            quantity: $data['quantity'],
            description: $data['description'],
            item: isset($data['item']) ? JobTaskItem::fromResponse($data['item']) : null,
            has_item: $data['has_item'],
            quantity_remaining: $data['quantity_remaining'],
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
