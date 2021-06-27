<?php

namespace pkmnfriends\Infrastructure\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

abstract class ModelAbstract extends Model implements Transformable
{
    use TransformableTrait;
}
