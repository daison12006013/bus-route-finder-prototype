<?php

namespace Daison\BusRouterSg\Http\Controllers;

use Daison\BusRouterSg\Util;
use Illuminate\Http\Request;

class Welcome extends Controller
{
    public function __invoke(Request $request)
    {
        $params = [
            'myLat' => $myLat = $request->get('my_lat', 1.35858),
            'myLng' => $myLng = $request->get('my_lng', 103.98402),
            'destLat' => $destLat = $request->get('dest_lat', 1.25435),
            'destLng' => $destLng = $request->get('dest_lng', 103.82639),
        ];

        $match = new Util\Match($myLat, $myLng, $destLat, $destLng);

        $params['myNearestBus'] = $match->getNearestBus($myLat, $myLng)->paginate(10, ['*'], 'my_page');
        $params['destNearestBus'] = $match->getNearestBus($destLat, $destLng)->paginate(10, ['*'], 'dest_page');

        $params['routes'] = $this->getRoutes($match);

        return view('bus-router-sg::index', $params);
    }

    /**
     * [getRoutes description]
     *
     * @param  [type] $myLat   [description]
     * @param  [type] $myLng   [description]
     * @param  [type] $destLat [description]
     * @param  [type] $destLng [description]
     * @return [type]          [description]
     */
    protected function getRoutes($match)
    {
        return $match->handle();
    }
}
