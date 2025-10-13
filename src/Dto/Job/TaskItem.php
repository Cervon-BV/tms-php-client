<?php

namespace Cervon\Tms\Dto\Job;

class TaskItem
{
    public function __construct(
        public string $name,
        public ?string $public_name,
        public ?float $length,
        public ?float $width,
        public ?float $height,
        public ?float $weight,
        public ?string $barcode,
        public ?float $volume,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            name: $data['name'],
            public_name: $data['public_name'] ?? null,
            length: $data['length'] ?? null,
            width: $data['width'] ?? null,
            height: $data['height'] ?? null,
            weight: $data['weight'] ?? null,
            barcode: $data['barcode'] ?? null,
            volume: $data['volume'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
