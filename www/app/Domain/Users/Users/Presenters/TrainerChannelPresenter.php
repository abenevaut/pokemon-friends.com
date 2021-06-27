<?php

namespace pkmnfriends\Domain\Users\Users\Presenters;

use pkmnfriends\Infrastructure\Presenters\PresenterAbstract;
use pkmnfriends\Domain\Users\Users\Transformers\TrainerChannelTransformer;

class TrainerChannelPresenter extends PresenterAbstract
{

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TrainerChannelTransformer();
    }
}
