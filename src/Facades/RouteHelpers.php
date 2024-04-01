<?php

namespace A17\Twill\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getAuthRedirectPath()
 */
class RouteHelpers extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \A17\Twill\Helpers\RouteHelpers::class;
    }
}
