<?php

namespace Cervon\Tms\Dto;

class ChecklistItem
{
    public function __construct(
        public string $description,
        public ?RequiredOptions $required_options,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            description: $data['description'],
            required_options: isset($data['required_options'])
                ? RequiredOptions::fromResponse($data['required_options'])
                : null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}

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
