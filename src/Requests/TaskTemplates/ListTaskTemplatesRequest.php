<?php

namespace Cervon\Tms\Requests\TaskTemplates;

use Cervon\Tms\Dto\TaskTemplate;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\Traits\Body\HasJsonBody;

class ListTaskTemplatesRequest extends Request implements Paginatable, HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $filters = [],
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/task-templates/list';
    }

    protected function defaultBody(): array
    {
        return $this->filters;
    }

    /** @return array<int, TaskTemplate> */
    public function createDtoFromResponse(Response $response): array
    {
        return TaskTemplate::collect($response->json());
    }
}
