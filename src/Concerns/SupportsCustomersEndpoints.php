<?php

namespace Cervon\Tms\Concerns;

use Cervon\Tms\Dto\Customer;
use Cervon\Tms\Requests\Customers\CreateCustomerRequest;
use Cervon\Tms\Requests\Customers\DeleteCustomerRequest;
use Cervon\Tms\Requests\Customers\ListCustomersRequests;
use Cervon\Tms\Requests\Customers\UpdateCustomerRequest;
use Cervon\Tms\Tms;

/** @mixin Tms */
trait SupportsCustomersEndpoints
{
    /** @return iterable<int, Customer> */
    public function listCustomers(array $filters = []): iterable
    {
        $request = new ListCustomersRequests($filters);

        /** @var iterable<int, Customer> $items */
        $items = $this->paginate($request)->items();

        return $items;
    }

    public function createCustomer(array $properties): Customer
    {
        $request = new CreateCustomerRequest($properties);

        return $this->send($request)->dto();
    }

    public function updateCustomer(string $_id, array $properties): Customer
    {
        $request = new UpdateCustomerRequest($_id, $properties);

        return $this->send($request)->dto();
    }

    public function deleteCustomer(string $_id): self
    {
        $request = new DeleteCustomerRequest($_id);

        $this->send($request);

        return $this;
    }
}
