<?php

namespace Cervon\Tms\Requests\Customers;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteCustomerRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected string $_id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/customers/{$this->_id}";
    }
}
