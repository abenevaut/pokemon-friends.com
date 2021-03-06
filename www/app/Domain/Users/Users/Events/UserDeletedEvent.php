<?php

namespace pkmnfriends\Domain\Users\Users\Events;

use pkmnfriends\Infrastructure\Events\EventAbstract;
use pkmnfriends\Domain\Users\Users\User;

class UserDeletedEvent extends EventAbstract
{

    /**
     * @var User|null
     */
    public $user = null;

    /**
     * UserUpdatedEvent constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
