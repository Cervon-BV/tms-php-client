<?php

namespace Cervon\Tms\Dto\Customer;

class Config
{
    public function __construct(
        public ?bool $need_proposal,
        public ?string $cc_all_communication,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            need_proposal: $data['need_proposal'] ?? null,
            cc_all_communication: $data['cc_all_communication'] ?? null,
        );
    }
}
