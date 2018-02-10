<?php

namespace Daison\BusRouterSg\Http\Controllers\Buses;

class Lists extends \Daison\BusRouterSg\Http\Controllers\Controller
{
    public function __invoke()
    {
        return view(package('buses.lists'));
    }
}
