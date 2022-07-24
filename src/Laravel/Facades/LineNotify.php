<?php

namespace LineSDK\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class LineNotify extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'linenotify'; // same as bind method in service provider
    }
}
