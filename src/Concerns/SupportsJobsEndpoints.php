<?php

namespace Jacobtims\Tms\Concerns;

use Jacobtims\Tms\Dto\Job;
use Jacobtims\Tms\Requests\Jobs\ListJobsRequests;
use Jacobtims\Tms\Tms;

/** @mixin Tms */
trait SupportsJobsEndpoints
{
    /** @return iterable<int, Job> */
    public function listJobs(array $filters = []): iterable
    {
        $request = new ListJobsRequests($filters);

        /** @var iterable<int, Job> $items */
        $items = $this->paginate($request)->items();

        return $items;
    }
}
