<?php

namespace Jacobtims\Tms\Dto;

use Jacobtims\Tms\Dto\References\AddressReference;
use Jacobtims\Tms\Dto\References\ContactReference;
use Jacobtims\Tms\Dto\References\CustomerReference;
use Jacobtims\Tms\Dto\References\PaymentReference;
use Jacobtims\Tms\Dto\References\TourReference;

class Job
{
    public function __construct(
        public string $_id,
        public int $number,
        public string $reference,
        public CustomerReference $customer,
        public ContactReference $contact,
        public AddressReference $address,
        /** @var JobTask[] */
        public array $tasks,
        public ?PaymentReference $outstanding_payment,
        public ?int $total_tasks,
        public ?int $total_items,
        public ?bool $has_assemble,
        public string $status,
        public ?TourReference $tour,
        public ?string $arrival_time,
        public ?int $service_time,
        public ?bool $need_proposal,
        public ?bool $drop_permission,
        public ?bool $co_driver_needed,
        public ?string $updated_date,
        public ?string $created_date,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            _id: $data['_id'],
            number: $data['number'],
            reference: $data['reference'],
            customer: CustomerReference::fromResponse($data['customer']),
            contact: ContactReference::fromResponse($data['contact']),
            address: AddressReference::fromResponse($data['address']),
            tasks: JobTask::collect($data['tasks'] ?? []),
            outstanding_payment: isset($data['outstanding_payment'])
                ? PaymentReference::fromResponse($data['outstanding_payment'])
                : null,
            total_tasks: $data['total_tasks'] ?? null,
            total_items: $data['total_items'] ?? null,
            has_assemble: $data['has_assemble'] ?? null,
            status: $data['status'],
            tour: isset($data['tour']) ? TourReference::fromResponse($data['tour']) : null,
            arrival_time: $data['arrival_time'] ?? null,
            service_time: $data['service_time'] ?? null,
            need_proposal: $data['need_proposal'] ?? null,
            drop_permission: $data['drop_permission'] ?? null,
            co_driver_needed: $data['co_driver_needed'] ?? null,
            updated_date: $data['updated_date'] ?? null,
            created_date: $data['created_date'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
