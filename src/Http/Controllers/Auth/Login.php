<?php

namespace Daison\BusRouterSg\Http\Controllers\Auth;

class Login extends \Daison\BusRouterSg\Http\Controllers\Controller
{
    public function __invoke()
    {
        return view(package('auth.login'));
    }
}
