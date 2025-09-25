<?php

namespace Jacobtims\Tms\Requests\Jobs;

use Jacobtims\Tms\Dto\Job;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\Traits\Body\HasJsonBody;

class ListJobsRequests extends Request implements Paginatable, HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/jobs/list';
    }

    /** @return array<int, Job> */
    public function createDtoFromResponse(Response $response): array
    {
        return Job::collect($response->json());
    }
}
