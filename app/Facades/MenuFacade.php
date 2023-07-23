<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class MenuFacade.
 */
class MenuFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Menu';
    }
}
