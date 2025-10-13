<?php

namespace Cervon\Tms\Requests\TaskTemplates;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteTaskTemplateRequest extends Request
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
