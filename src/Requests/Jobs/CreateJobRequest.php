<?php

namespace Cervon\Tms\Requests\Jobs;

use Cervon\Tms\Dto\Job;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateJobRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $properties,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/jobs';
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
