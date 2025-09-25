<?php

namespace Jacobtims\Tms\Concerns;

use Jacobtims\Tms\Dto\Job;
use Jacobtims\Tms\Requests\Jobs\ListJobsRequests;
use Jacobtims\Tms\Tms;

/** @mixin Tms */
trait SupportsJobsEndpoints
{
    /** @return iterable<int, Job> */
    public function listJobs(): iterable
    {
        $request = new ListJobsRequests();

        /** @var iterable<int, Job> $items */
        $items = $this->paginate($request)->items();

        return $items;
    }
}
