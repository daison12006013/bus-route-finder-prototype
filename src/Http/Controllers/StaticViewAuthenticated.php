<?php

namespace Daison\BusRouterSg\Http\Controllers;

use Daison\BusRouterSg\Http\Requests\StaticViewAuthenticatedRequest as Request;

class StaticViewAuthenticated extends Controller
{
    const ALLOWED_BLADES = [
        'bus-router-sg::buses.add',
        'bus-router-sg::buses.update',
    ];

    public function __invoke(Request $request)
    {
        return view($request->get('blade'));
    }
}
