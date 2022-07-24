<?php

namespace LineSDK\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class LineBot extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'linebot'; // same as bind method in service provider
    }
}
