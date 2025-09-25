<?php

namespace Jacobtims\Tms;

use Saloon\Contracts\Body\HasBody;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\CursorPaginator;

class TmsPaginator extends CursorPaginator
{
    protected ?int $perPageLimit = 100;

    protected function getNextCursor(Response $response): int | string
    {
        $items = $response->json(default: []);
        $lastItem = $items[array_key_last($items)];

        return $lastItem['_id'] ?? '';
    }

    protected function isLastPage(Response $response): bool
    {
        return count($response->json(default: [])) <= 0;
    }

    protected function getPageItems(Response $response, Request $request): array
    {
        return $request->createDtoFromResponse($response);
    }

    protected function applyPagination(Request $request): Request
    {
        if ($this->currentResponse instanceof Response) {
            $request->query()->add('from', $this->getNextCursor($this->currentResponse));
        }

        if (isset($this->perPageLimit)) {
            $request->query()->add('limit', $this->perPageLimit);
        }

        // Make pagination work on POST /list requests
        if ($request instanceof HasBody) {
            if ($this->currentResponse instanceof Response) {
                $request->body()->add('from', $this->getNextCursor($this->currentResponse));
            }

            if (isset($this->perPageLimit)) {
                $request->body()->add('limit', $this->perPageLimit);
            }
        }

        return $request;
    }
}
