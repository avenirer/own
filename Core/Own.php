<?php
namespace Core;
use App;

class Own
{
    function __construct()
    {
        $route = new Router;
        $route->serve();
    }
}