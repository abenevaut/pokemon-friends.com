<?php

namespace pkmnfriends\Domain\Users\Users\Repositories;

use pkmnfriends\Infrastructure\Repositories\RepositoryInterface;

interface UsersResetPasswordRepositoryInterface extends RepositoryInterface
{

    /**
     * @return array
     */
    public function getResetPasswordRules(): array;
}
