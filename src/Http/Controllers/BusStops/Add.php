<?php

namespace Daison\BusRouterSg\Http\Controllers\BusStops;

class Add extends \Daison\BusRouterSg\Http\Controllers\Controller
{
    public function __invoke()
    {
        return view(package('bus-stops.add'));
    }
}
