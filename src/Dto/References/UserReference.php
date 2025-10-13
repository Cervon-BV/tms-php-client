<?php

namespace Cervon\Tms\Dto\References;

class UserReference
{
    public function __construct(
        public string $_id,
        public string $code,
        public string $date,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            _id: $data['_id'],
            code: $data['code'],
            date: $data['date'],
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
