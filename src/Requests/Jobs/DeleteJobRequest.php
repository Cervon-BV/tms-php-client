<?php

namespace Jacobtims\Tms\Requests\Jobs;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteJobRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected string $_id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/jobs/{$this->_id}";
    }
}
