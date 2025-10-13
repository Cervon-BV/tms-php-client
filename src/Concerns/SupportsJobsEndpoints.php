<?php

namespace Cervon\Tms\Concerns;

use Cervon\Tms\Dto\Job;
use Cervon\Tms\Requests\Jobs\CreateJobRequest;
use Cervon\Tms\Requests\Jobs\DeleteJobRequest;
use Cervon\Tms\Requests\Jobs\ListJobsRequests;
use Cervon\Tms\Requests\Jobs\UpdateJobRequest;
use Cervon\Tms\Tms;

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

    public function createJob(array $properties): Job
    {
        $request = new CreateJobRequest($properties);

        return $this->send($request)->dto();
    }

    public function updateJob(string $_id, array $properties): Job
    {
        $request = new UpdateJobRequest($_id, $properties);

        return $this->send($request)->dto();
    }

    public function deleteJob(string $_id): self
    {
        $request = new DeleteJobRequest($_id);

        $this->send($request);

        return $this;
    }
}
