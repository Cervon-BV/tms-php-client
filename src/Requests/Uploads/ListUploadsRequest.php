<?php

namespace Cervon\Tms\Requests\Uploads;

use Cervon\Tms\Dto\Upload;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\Traits\Body\HasJsonBody;

class ListUploadsRequest extends Request implements Paginatable, HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $filters = [],
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/uploads/list';
    }

    protected function defaultBody(): array
    {
        return $this->filters;
    }

    /** @return array<int, Upload> */
    public function createDtoFromResponse(Response $response): array
    {
        return Upload::collect($response->json());
    }
}
