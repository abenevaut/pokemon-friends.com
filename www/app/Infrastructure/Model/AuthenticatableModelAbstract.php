<?php

namespace pkmnfriends\Infrastructure\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

abstract class AuthenticatableModelAbstract extends Authenticatable implements Transformable
{
    use TransformableTrait;
}
