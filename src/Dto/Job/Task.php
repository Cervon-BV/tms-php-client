<?php

namespace Cervon\Tms\Dto\Job;

class Task
{
    public function __construct(
        public string $tid,
        public string $type,
        public int $quantity,
        public ?string $description,
        public ?TaskItem $item,
        /** @var TaskChecklist[] */
        public ?array $checklist,
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
            description: $data['description'] ?? null,
            item: isset($data['item']) ? TaskItem::fromResponse($data['item']) : null,
            checklist: isset($data['checklist']) ? TaskChecklist::collect($data['checklist']) : null,
            has_item: $data['has_item'] ?? null,
            quantity_remaining: $data['quantity_remaining'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
