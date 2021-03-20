<?php

namespace pkmnfriends\Infrastructure\Model;

/**
 * Allows to load entity as route arguments from uniquid field.
 *
 * @package pkmnfriends\Infrastructure\Model
 */
trait RouteKeyNameUniquidTrait
{

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uniqid';
    }
}
