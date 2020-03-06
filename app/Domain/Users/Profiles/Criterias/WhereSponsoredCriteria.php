<?php

namespace template\Domain\Users\Profiles\Criterias;

use Prettus\Repository\Contracts\RepositoryInterface;
use template\Infrastructure\Contracts\Criterias\CriteriaAbstract;

class WhereSponsoredCriteria extends CriteriaAbstract
{

    /**
     * @param $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('sponsored', '=', true);
    }
}
