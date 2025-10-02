<?php

namespace Jacobtims\Tms\Requests\TaskTemplates;

use Jacobtims\Tms\Dto\TaskTemplate;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\Traits\Body\HasJsonBody;

class UpdateTaskTemplateRequests extends Request implements HasBody
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
        return "/task-templates/{$this->_id}";
    }

    protected function defaultBody(): array
    {
        return $this->properties;
    }

    public function createDtoFromResponse(Response $response): TaskTemplate
    {
        return TaskTemplate::fromResponse($response->json());
    }
}
