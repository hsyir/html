<?php
namespace Hsy\Html;

class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return "Html";
    }
}
