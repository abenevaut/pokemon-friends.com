<?php

namespace pkmnfriends\Domain\Users\Profiles\Criterias;

use Prettus\Repository\Contracts\RepositoryInterface;
use pkmnfriends\Infrastructure\Criterias\CriteriaAbstract;

class WhereFriendCodeNotNullCriteria extends CriteriaAbstract
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->whereNotNull('friend_code');
    }
}
