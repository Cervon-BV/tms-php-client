<?php

namespace Cervon\Tms\Dto\Job;

class TaskChecklistCompletion
{
    public function __construct(
        public bool $completed,
        /** @var array<string> */
        public array $values,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            completed: $data['completed'],
            values: $data['values'],
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
