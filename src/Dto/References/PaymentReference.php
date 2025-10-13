<?php

namespace Cervon\Tms\Dto\References;

class PaymentReference
{
    public function __construct(
        public float $value,
        public string $currency,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            value: $data['value'],
            currency: $data['currency'],
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
