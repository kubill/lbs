<?php

namespace Kubill\Lbs\Facades;

/**
 * Class GeoCoder
 * @method static array addr2coder($address)
 * @package Kubill\Lbs\Facades
 */
class GeoCoder extends \Illuminate\Support\Facades\Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'GeoCoder';
    }
}
