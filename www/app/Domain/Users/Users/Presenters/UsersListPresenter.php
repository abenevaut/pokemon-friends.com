<?php

namespace pkmnfriends\Domain\Users\Users\Presenters;

use pkmnfriends\Infrastructure\Presenters\PresenterAbstract;
use pkmnfriends\Domain\Users\Users\Transformers\UsersListTransformer;

class UsersListPresenter extends PresenterAbstract
{

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UsersListTransformer();
    }
}
