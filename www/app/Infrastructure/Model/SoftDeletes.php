<?php

namespace pkmnfriends\Infrastructure\Model;

use Illuminate\Database\Eloquent\SoftDeletes as EloquentSoftDeletes;

trait SoftDeletes
{
    use EloquentSoftDeletes;
}
