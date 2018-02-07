<?php

namespace Daison\BusRouterSg\Http\Controllers;

use Daison\BusRouterSg\Http\Requests\StaticViewRequest as Request;

class StaticView extends Controller
{
    const ALLOWED_BLADES = [
        'bus-router-sg::auth.login',
    ];

    public function __invoke(Request $request)
    {
        return view($request->get('blade'));
    }
}
