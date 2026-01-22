<?php

namespace Cervon\Tms\Dto\Customer;

class Address
{
    public function __construct(
        public string $zip,
        public string $street_number,
        public string $city,
        public string $street,
        public string $country,
        public ?float $latitude,
        public ?float $longitude,
        public ?string $description,
        public ?bool $valid,
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
            latitude: isset($data['latitude']) ? floatval($data['latitude']) : null,
            longitude: isset($data['longitude']) ? floatval($data['longitude']) : null,
            description: $data['description'] ?? null,
            valid: $data['valid'] ?? null,
        );
    }
}
