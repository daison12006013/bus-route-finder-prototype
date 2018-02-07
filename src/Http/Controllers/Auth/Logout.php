<?php

namespace Daison\BusRouterSg\Http\Controllers\Auth;

class Logout extends \Daison\BusRouterSg\Http\Controllers\Controller
{
    public function __invoke()
    {
        \Auth::logout();

        return redirect(route(route_name('welcome')));
    }
}
