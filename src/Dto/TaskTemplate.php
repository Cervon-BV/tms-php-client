<?php

namespace Cervon\Tms\Dto;

use Cervon\Tms\Dto\Job\TaskItem;

class TaskTemplate
{
    public function __construct(
        public string    $_id,
        public string    $name,
        public string    $type,
        public int       $quantity,
        public ?string   $description,
        public ?TaskItem $item,
        /** @var ChecklistItem[] */
        public array     $checklist,
        public ?bool     $has_item,
        public ?int      $quantity_remaining,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            _id: $data['_id'],
            name: $data['name'],
            type: $data['type'],
            quantity: $data['quantity'],
            description: $data['description'] ?? null,
            item: isset($data['item']) ? TaskItem::fromResponse($data['item']) : null,
            checklist: ChecklistItem::collect($data['checklist'] ?? []),
            has_item: $data['has_item'] ?? null,
            quantity_remaining: $data['quantity_remaining'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
