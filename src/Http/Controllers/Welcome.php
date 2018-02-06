<?php

namespace Daison\BusRouterSg\Http\Controllers;

use Daison\BusRouterSg\Util;
use Illuminate\Http\Request;

class Welcome extends Controller
{
    public function __invoke(Request $request)
    {
        $params = [
            'myLat' => $myLat = $request->get('my_lat', 1.37313809346006),
            'myLng' => $myLng = $request->get('my_lng', 103.89156818388481),
            'destLat' => $destLat = $request->get('dest_lat', 1.38372439268243),
            'destLng' => $destLng = $request->get('dest_lng', 103.76068878232401),
        ];

        $match = new Util\Match($myLat, $myLng, $destLat, $destLng);

        $params['myNearestBus'] = $match->getNearestBus($myLat, $myLng)->paginate(10, ['*'], 'my_page');
        // $params['destNearestBus'] = $match->getNearestBus($destLat, $destLng)->paginate(10, ['*'], 'dest_page');
        $params['routes'] = $match->getBuses($this->getRoutes($match));

        $params['user'] = $request->user();

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
