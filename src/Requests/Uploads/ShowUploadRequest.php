<?php

namespace Cervon\Tms\Requests\Uploads;

use Cervon\Tms\Dto\Upload;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class ShowUploadRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $_id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/upload/{$this->_id}";
    }

    public function createDtoFromResponse(Response $response): Upload
    {
        return Upload::fromResponse($response->json());
    }
}
