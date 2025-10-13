<?php

namespace Cervon\Tms\Concerns;

use Cervon\Tms\Dto\Upload;
use Cervon\Tms\Requests\Uploads\ListUploadsRequest;
use Cervon\Tms\Tms;

/** @mixin Tms */
trait SupportsUploadsEndpoints
{
    /** @return iterable<int, Upload> */
    public function listUploads(array $filters = []): iterable
    {
        $request = new ListUploadsRequest($filters);

        /** @var iterable<int, Upload> $items */
        $items = $this->paginate($request)->items();

        return $items;
    }
}
