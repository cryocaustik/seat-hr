<?php

namespace Cryocaustik\SeatHr;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Cryocaustik\SeatHr\Skeleton\SkeletonClass
 */
class SeatHrFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'seat-hr';
    }
}
