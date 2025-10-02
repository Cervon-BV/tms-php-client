<?php

namespace Jacobtims\Tms\Requests\Jobs;

use Jacobtims\Tms\Dto\Job;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateJobRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        protected string $_id,
        protected array $properties,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/jobs/{$this->_id}";
    }

    protected function defaultBody(): array
    {
        return $this->properties;
    }

    public function createDtoFromResponse(Response $response): Job
    {
        return Job::fromResponse($response->json());
    }
}
