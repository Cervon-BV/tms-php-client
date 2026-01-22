<?php

namespace Cervon\Tms\Requests\Customers;

use Cervon\Tms\Dto\Customer;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateCustomerRequest extends Request implements HasBody
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
        return "/customers/{$this->_id}";
    }

    protected function defaultBody(): array
    {
        return $this->properties;
    }

    public function createDtoFromResponse(Response $response): Customer
    {
        return Customer::fromResponse($response->json());
    }
}
