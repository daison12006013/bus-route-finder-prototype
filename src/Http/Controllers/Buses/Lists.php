<?php

namespace Daison\BusRouterSg\Http\Controllers\Buses;

use Illuminate\Http\Request;
use Daison\BusRouterSg\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class Lists extends \Daison\BusRouterSg\Http\Controllers\Controller
{
    public function __invoke(Request $request)
    {
        $busRoutesCount = 'SELECT max(route) FROM bus_routes WHERE bus_routes.bus_id = buses.id GROUP BY bus_id';

        $builder = (new Models\Bus)
            ->newQuery()
            ->select('*')
            ->addSelect(
                DB::raw(sprintf('(%s) as bus_routes_count', $busRoutesCount))
            )
            ->orderBy('bus_number')

            # eager lazy loading each bus stops
            # this will only take effect to the pagination which we limit it
            # the iteration will always be fast since we only require less
            ->with(['stops']);

        # separating the filter from this invoke method.
        $this->handleFilter($builder, $request);

        return view(package('buses.lists'), [
            'buses' => $builder->paginate(2),
        ]);
    }

    /**
     * Handle filtration.
     *
     * @param  \Illuminate\Database\Query\Builder $builder
     * @param  Request $request
     * @return void
     */
    protected function handleFilter(Builder $builder, Request $request)
    {
        if ($keyword = $request->get('keyword')) {
            $modKeyword = '%'.$keyword.'%';

            $builder
                ->where('bus_number', 'LIKE', $modKeyword)
                ->orWhereHas('stops', function ($builder) use ($modKeyword) {
                    $builder
                        ->where('bus_stops.name', 'LIKE', $modKeyword)
                        ->orWhere('bus_stops.bus_station_code', 'LIKE', $modKeyword);
                });
        }
    }
}
