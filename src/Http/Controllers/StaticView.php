<?php

namespace Daison\BusRouterSg\Http\Controllers;

use Daison\BusRouterSg\Http\Requests\StaticViewRequest as Request;

class StaticView extends Controller
{
    const ALLOWED_BLADES = [
        'search',
    ];

    public function __invoke(Request $request)
    {
        return view(package($request->get('blade')));
    }
}
