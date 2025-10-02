<?php

namespace Jacobtims\Tms\Requests\TaskTemplates;

use Jacobtims\Tms\Dto\TaskTemplate;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\Traits\Body\HasJsonBody;

class DeleteTaskTemplateRequests extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected string $_id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/task-templates/{$this->_id}";
    }
}
