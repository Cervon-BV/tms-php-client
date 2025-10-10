<?php

namespace Jacobtims\Tms\Dto\References;

class CustomerReference
{
    public function __construct(
        public string $_id,
        public string $name,
        public ?string $logo,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            _id: $data['_id'],
            name: $data['name'],
            logo: $data['logo'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
