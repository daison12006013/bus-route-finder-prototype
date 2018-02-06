<?php

namespace Daison\BusRouterSg\Http\Controllers\Buses;

class Add extends \Daison\BusRouterSg\Http\Controllers\Controller
{
    public function __invoke()
    {
        return view('bus-router-sg::buses.add');
    }
}
