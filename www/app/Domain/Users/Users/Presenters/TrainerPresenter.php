<?php

namespace pkmnfriends\Domain\Users\Users\Presenters;

use pkmnfriends\Infrastructure\Presenters\PresenterAbstract;
use pkmnfriends\Domain\Users\Users\Transformers\TrainerTransformer;

class TrainerPresenter extends PresenterAbstract
{

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TrainerTransformer();
    }
}
