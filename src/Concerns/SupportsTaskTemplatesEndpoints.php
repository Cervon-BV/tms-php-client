<?php

namespace Cervon\Tms\Concerns;

use Cervon\Tms\Dto\TaskTemplate;
use Cervon\Tms\Requests\TaskTemplates\CreateTaskTemplateRequest;
use Cervon\Tms\Requests\TaskTemplates\DeleteTaskTemplateRequest;
use Cervon\Tms\Requests\TaskTemplates\ListTaskTemplatesRequest;
use Cervon\Tms\Requests\TaskTemplates\UpdateTaskTemplateRequest;
use Cervon\Tms\Tms;

/** @mixin Tms */
trait SupportsTaskTemplatesEndpoints
{
    /** @return iterable<int, TaskTemplate> */
    public function listTaskTemplates(array $filters = []): iterable
    {
        $request = new ListTaskTemplatesRequest($filters);

        /** @var iterable<int, TaskTemplate> $items */
        $items = $this->paginate($request)->items();

        return $items;
    }

    public function createTaskTemplate(array $properties): TaskTemplate
    {
        $request = new CreateTaskTemplateRequest($properties);

        return $this->send($request)->dto();
    }

    public function updateTaskTemplate(string $_id, array $properties): TaskTemplate
    {
        $request = new UpdateTaskTemplateRequest($_id, $properties);

        return $this->send($request)->dto();
    }

    public function deleteTaskTemplate(string $_id): self
    {
        $request = new DeleteTaskTemplateRequest($_id);

        $this->send($request);

        return $this;
    }
}
