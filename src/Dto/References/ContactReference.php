<?php

namespace Jacobtims\Tms\Dto\References;

class ContactReference
{
    public function __construct(
        public string $name,
        public string $phone,
        public string $email,
        public string $locale,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            name: $data['name'],
            phone: $data['phone'],
            email: $data['email'],
            locale: $data['locale'],
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
