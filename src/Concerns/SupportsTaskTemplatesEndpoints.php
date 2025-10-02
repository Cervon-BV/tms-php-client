<?php

namespace Jacobtims\Tms\Concerns;

use Jacobtims\Tms\Dto\TaskTemplate;
use Jacobtims\Tms\Requests\TaskTemplates\CreateTaskTemplateRequests;
use Jacobtims\Tms\Requests\TaskTemplates\DeleteTaskTemplateRequests;
use Jacobtims\Tms\Requests\TaskTemplates\ListTaskTemplatesRequests;
use Jacobtims\Tms\Requests\TaskTemplates\UpdateTaskTemplateRequests;
use Jacobtims\Tms\Tms;

/** @mixin Tms */
trait SupportsTaskTemplatesEndpoints
{
    /** @return iterable<int, TaskTemplate> */
    public function listTaskTemplates(array $filters = []): iterable
    {
        $request = new ListTaskTemplatesRequests($filters);

        /** @var iterable<int, TaskTemplate> $items */
        $items = $this->paginate($request)->items();

        return $items;
    }

    public function createTaskTemplate(array $properties): TaskTemplate
    {
        $request = new CreateTaskTemplateRequests($properties);

        return $this->send($request)->dto();
    }

    public function updateTaskTemplate(string $_id, array $properties): TaskTemplate
    {
        $request = new UpdateTaskTemplateRequests($_id, $properties);

        return $this->send($request)->dto();
    }

    public function deleteTaskTemplate(string $_id): self
    {
        $request = new DeleteTaskTemplateRequests($_id);

        $this->send($request);

        return $this;
    }
}
