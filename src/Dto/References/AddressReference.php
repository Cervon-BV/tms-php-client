<?php

namespace Cervon\Tms\Dto\References;

class AddressReference
{
    public function __construct(
        public string $zip,
        public string $street_number,
        public string $city,
        public string $street,
        public string $country,
        public ?float $latitude,
        public ?float $longitude,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            zip: $data['zip'],
            street_number: $data['street_number'],
            city: $data['city'],
            street: $data['street'],
            country: $data['country'],
            latitude: $data['latitude'] ?? null,
            longitude: $data['longitude'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
