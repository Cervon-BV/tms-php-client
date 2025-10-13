<?php

namespace Cervon\Tms\Dto\References;

class UserReference
{
    public function __construct(
        public string $_id,
        public string $first_name,
        public string $last_name,
        public ?string $avatar,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            _id: $data['_id'],
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            avatar: $data['avatar'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
