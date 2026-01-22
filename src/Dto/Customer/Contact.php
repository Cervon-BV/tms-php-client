<?php

namespace Cervon\Tms\Dto\Customer;

class Contact
{
    public function __construct(
        public ?string $company,
        public string $name,
        public string $phone,
        public string $email,
        public string $locale,
        public ?bool $disable_notifications,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            company: $data['company'] ?? null,
            name: $data['name'],
            phone: $data['phone'],
            email: $data['email'],
            locale: $data['locale'],
            disable_notifications: $data['disable_notifications'] ?? null,
        );
    }
}
