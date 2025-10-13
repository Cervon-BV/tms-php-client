<?php

namespace Cervon\Tms\Dto\Job;

class TaskChecklist
{
    public function __construct(
        public string $cid,
        public ?string $description,
        public ?TaskChecklistRequiredOptions $required_options,
        public ?TaskChecklistCompletion $completion,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            cid: $data['cid'] ?? '',
            description: $data['description'] ?? null,
            required_options: isset($data['required_options'])
                ? TaskChecklistRequiredOptions::fromResponse($data['required_options'])
                : null,
            completion: isset($data['completion'])
                ? TaskChecklistCompletion::fromResponse($data['completion'])
                : null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
