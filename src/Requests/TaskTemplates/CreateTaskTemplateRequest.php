<?php

namespace Cervon\Tms\Requests\TaskTemplates;

use Cervon\Tms\Dto\TaskTemplate;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateTaskTemplateRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $properties,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/task-templates';
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
