<?php

namespace Cervon\Tms\Dto\Job;

use Cervon\Tms\Dto\References\UserReference;

class Completion
{
    public function __construct(
        public ?string $reason,
        public ?UserReference $user,
        public string $completed_time,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            reason: $data['reason'],
            user: isset($data['user']) ? UserReference::fromResponse($data['user']) : null,
            completed_time: $data['completed_time'],
        );
    }
}
