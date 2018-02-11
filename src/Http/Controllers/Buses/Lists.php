<?php

namespace Daison\BusRouterSg\Http\Controllers\Buses;

use Daison\BusRouterSg\Models;
use Illuminate\Support\Facades\DB;

class Lists extends \Daison\BusRouterSg\Http\Controllers\Controller
{
    public function __invoke()
    {
        $builder = (new Models\Bus)->newQuery();

        $builder
            ->select('*')
            ->addSelect(
                DB::raw('(SELECT max(route) FROM bus_routes WHERE bus_routes.bus_id = buses.id GROUP BY bus_id) as bus_routes_count')
            )
            ->addSelect(
                DB::raw('(SELECT max(route) FROM bus_routes WHERE bus_routes.bus_id = buses.id GROUP BY bus_id) as bus_routes_count')
            )
            ->orderBy('bus_number');

        return view(package('buses.lists'), [
            'buses' => $builder->paginate(10),
        ]);
    }
}
