<?php

namespace pkmnfriends\Domain\Users\Users\Criterias;

use Prettus\Repository\Contracts\RepositoryInterface;
use pkmnfriends\Infrastructure\Criterias\CriteriaAbstract;

class WhereUniqIdIsDifferentCriteria extends CriteriaAbstract
{

    /**
     * @var string $uniqid
     */
    private $uniqid = null;

    /**
     * @param string $uniqid
     */
    public function __construct($uniqid = '')
    {
        $this->uniqid = $uniqid;
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('uniqid', '<>', $this->uniqid);
    }
}
