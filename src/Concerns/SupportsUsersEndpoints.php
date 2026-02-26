<?php

namespace Cervon\Tms\Concerns;

use Cervon\Tms\Dto\References\UserReference;
use Cervon\Tms\Requests\Users\ShowUserByBadgeRequest;
use Cervon\Tms\Tms;

/** @mixin Tms */
trait SupportsUsersEndpoints
{
    public function showUserByBadge(string $badge): UserReference
    {
        $request = new ShowUserByBadgeRequest($badge);

        return $this->send($request)->dto();
    }
}
