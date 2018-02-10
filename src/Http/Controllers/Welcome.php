<?php

namespace Daison\BusRouterSg\Http\Controllers;

use Daison\BusRouterSg\Util;
use Daison\BusRouterSg\Models;
use Daison\BusRouterSg\Http\Requests\WelcomeRequest as Request;

class Welcome extends Controller
{
    const SEARCH_BY_POSTAL_CODE = 'postal-code';
    const SEARCH_BY_LAT_LNG = 'lat-lng';

    public function __invoke(Request $request)
    {
        $params = [];

        switch ($request->get('submit')) {
            case static::SEARCH_BY_POSTAL_CODE:
                $params = $this->searchByPostalCode($request);
                break;

            case static::SEARCH_BY_LAT_LNG:
                $params = $this->searchByLatLng($request);
                break;
        }

        return view(package('index'), $params);
    }

    /**
     * Search by postal code.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function searchByPostalCode($request)
    {
        $my = Models\Place::where('postal_code', $request->get('my_postal_code'))->first();
        $dest = Models\Place::where('postal_code', $request->get('dest_postal_code'))->first();

        $myLat = $my->lat;
        $myLng = $my->lng;
        $destLat = $dest->lat;
        $destLng = $dest->lng;

        $match = new Util\Match($myLat, $myLng, $destLat, $destLng);

        $params['myNearestBus'] = $match->getNearestBus($myLat, $myLng)->paginate(10, ['*'], 'my_page');
        $params['destNearestBus'] = $match->getNearestBus($destLat, $destLng)->paginate(10, ['*'], 'dest_page');
        $params['routes'] = $match->handle();

        return $params;
    }

    /**
     * Search by latitude and longitude.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function searchByLatLng($request)
    {
        $params = [
            'myLat' => $myLat = $request->get('my_lat'),
            'myLng' => $myLng = $request->get('my_lng'),
            'destLat' => $destLat = $request->get('dest_lat'),
            'destLng' => $destLng = $request->get('dest_lng'),
        ];

        $match = new Util\Match($myLat, $myLng, $destLat, $destLng);

        $params['myNearestBus'] = $match->getNearestBus($myLat, $myLng)->paginate(10, ['*'], 'my_page');
        $params['destNearestBus'] = $match->getNearestBus($destLat, $destLng)->paginate(10, ['*'], 'dest_page');
        $params['routes'] = $match->handle();

        return $params;
    }
}
