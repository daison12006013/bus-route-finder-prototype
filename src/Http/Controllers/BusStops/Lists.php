<?php

namespace Daison\BusRouterSg\Http\Controllers\BusStops;

use Daison\BusRouterSg\Models;
use Illuminate\Support\Facades\DB;

class Lists extends \Daison\BusRouterSg\Http\Controllers\Controller
{
    public function __invoke()
    {
        $builder = (new Models\BusStop)->newQuery();
        $builder
            ->orderBy('bus_station_code')
            # eager lazy loading when running paginate() to include the relationship 'buses'
            ->with(['buses']);

        return view(package('bus-stops.lists'), [
            'busStops' => $builder->paginate(10),
        ]);
    }
}
