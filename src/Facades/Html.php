<?php

namespace Hsy\Html\Facades;
use Hsy\Html\Html as HtmlClass;
use Illuminate\Support\Facades\Facade;

class Html extends Facade
{
    protected static function getFacadeAccessor()
    {
        return HtmlClass::class;
    }
}
