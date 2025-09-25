<?php

namespace Jacobtims\Tms\Dto;

class JobTaskItem
{
    public function __construct(
        public string $name,
        public float $length,
        public float $width,
        public float $height,
        public float $weight,
        public string $barcode,
        public float $volume,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            name: $data['name'],
            length: $data['length'],
            width: $data['width'],
            height: $data['height'],
            weight: $data['weight'],
            barcode: $data['barcode'],
            volume: $data['volume'],
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
