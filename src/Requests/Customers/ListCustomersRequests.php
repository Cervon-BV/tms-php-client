<?php

namespace Cervon\Tms\Requests\Customers;

use Cervon\Tms\Dto\Customer;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\Traits\Body\HasJsonBody;

class ListCustomersRequests extends Request implements Paginatable, HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $filters = [],
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/customers/list';
    }

    protected function defaultBody(): array
    {
        return $this->filters;
    }

    /** @return array<int, Customer> */
    public function createDtoFromResponse(Response $response): array
    {
        return Customer::collect($response->json());
    }
}
