<?php

namespace Cervon\Tms\Dto;

use Cervon\Tms\Dto\Customer\Address;
use Cervon\Tms\Dto\Customer\Config;
use Cervon\Tms\Dto\Customer\Contact;

class Customer
{
    public function __construct(
        public string    $_id,
        public string    $name,
        public ?string    $logo,
        public ?Config   $config,
        public ?Address $visit_address,
        public ?Address $sender_address,
        public ?Address $postal_address,
        public ?Contact $general_contact,
        public ?Contact $technical_contact,
        public ?Contact $financial_contact,
        public ?Contact $sender_contact,
        public ?string   $updated_date,
        public ?string   $created_date,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            _id: $data['_id'],
            name: $data['name'],
            logo: $data['logo'] ?? null,
            config: isset($data['config']) ? Config::fromResponse($data['config']) : null,
            visit_address: isset($data['visit_address']) ? Address::fromResponse($data['visit_address']) : null,
            sender_address: isset($data['sender_address']) ? Address::fromResponse($data['sender_address']) : null,
            postal_address: isset($data['postal_address']) ? Address::fromResponse($data['postal_address']) : null,
            general_contact: isset($data['general_contact']) ? Contact::fromResponse($data['general_contact']) : null,
            technical_contact: isset($data['technical_contact']) ? Contact::fromResponse($data['technical_contact']) : null,
            financial_contact: isset($data['financial_contact']) ? Contact::fromResponse($data['financial_contact']) : null,
            sender_contact: isset($data['sender_contact']) ? Contact::fromResponse($data['sender_contact']) : null,
            updated_date: $data['updated_date'] ?? null,
            created_date: $data['created_date'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
