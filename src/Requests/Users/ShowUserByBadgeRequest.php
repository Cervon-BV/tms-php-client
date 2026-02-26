<?php

namespace Cervon\Tms\Requests\Users;

use Cervon\Tms\Dto\References\UserReference;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class ShowUserByBadgeRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $badge,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/users/badge/{$this->badge}";
    }

    public function createDtoFromResponse(Response $response): UserReference
    {
        return UserReference::fromResponse($response->json());
    }
}
