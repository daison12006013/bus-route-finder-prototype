<?php

namespace Daison\BusRouterSg\Util;

use Hrgruri\Dijkstra\Graph;
use Daison\BusRouterSg\Models;
use Illuminate\Support\Facades\DB;

/**
 * A class that finds the shortest and buses to take to your destination.
 *
 * @author Daison Cariño <daison12006013@gmail.com>
 */
class Match
{
    /**
     * The starting point latitude.
     *
     * @var float
     */
    protected $myLat;

    /**
     * The starting point longitude.
     *
     * @var float
     */
    protected $myLng;

    /**
     * The ending point latitude.
     *
     * @var float
     */
    protected $destLat;

    /**
     * The ending point longitude.
     *
     * @var float
     */
    protected $destLng;

    /**
     * Constructor.
     *
     * @param float $myLat
     * @param float $myLng
     * @param float $destLat
     * @param float $destLng
     */
    public function __construct($myLat, $myLng, $destLat, $destLng)
    {
        $this->myLat = $myLat;
        $this->myLng = $myLng;
        $this->destLat = $destLat;
        $this->destLng = $destLng;
    }

    /**
     * Calculate the distance between the first lat and lng.
     *
     * @param  string $first
     * @param  string $second
     * @return float
     */
    public function getDistance($first, $second)
    {
        $exploded = explode(':', $first);
        $firstLat = $exploded[0];
        $firstLng = $exploded[1];

        $exploded = explode(':', $second);
        $secondLat = $exploded[0];
        $secondLng = $exploded[1];

        return 6371 * acos(
            cos( deg2rad( $firstLat ) )
            * cos( deg2rad( $secondLat ) )
            * cos( deg2rad( $secondLng ) - deg2rad( $firstLng ) )
            + sin( deg2rad( $firstLat ) )
            * sin( deg2rad( $secondLat ) )
        );
    }

    /**
     * Create a query builder using the bus_routes table.
     *
     * @return \Daison\BusRouterSg\Models\BusRoute
     */
    protected function getBuilder()
    {
        return Models\BusRoute::select('route', 'bus_number', 'bus_station_code', 'lat', 'lng', 'name')
            ->leftJoin('buses', 'buses.id', '=', 'bus_routes.bus_id')
            ->leftJoin('bus_stops', 'bus_stops.id', '=', 'bus_routes.bus_stop_id')
            ->orderBy('bus_routes.id', 'asc');
    }

    /**
     * Loads all buses routes using the Dijkstra's algorithm.
     *
     * @return \Hrgruri\Dijkstra\Graph
     */
    public function loadAllBusRoutes()
    {
        // define('LOAD_BUS_ROUTES', microtime(true));

        $formatted = [];

        foreach ($this->getBuilder()->get() as $record) {
            $formatted[$record->bus_number][] = [
                'bus_station_code' => $record->bus_station_code,
                'latlng' => $record->lat.':'.$record->lng,
            ];
        }

        $graph = new Graph();

        foreach ($formatted as $busRoutes) {
            $prev = null;

            foreach ($busRoutes as $route) {
                if ($prev === null) {
                    $prev = $route['latlng'];

                    continue;
                }

                $graph->add(
                    $prev,
                    $route['latlng'],
                    $this->getDistance($prev, $route['latlng'])
                );

                $prev = $route['latlng'];
            }
        }

        // dd(microtime() - LOAD_BUS_ROUTES);

        return $graph;
    }

    /**
     * Get all buses near my location.
     *
     * @return array
     */
    public function handle()
    {
        # we need to get the closests bus stops from our location
        $start = $this->getNearestBus($this->myLat, $this->myLng)->first();

        # we need to get the closests bus stops to our destination
        $end = $this->getNearestBus($this->destLat, $this->destLng)->first();

        $graph = $this->loadAllBusRoutes();

        return $graphResults = $graph->search($start->lat.':'.$start->lng, $end->lat.':'.$end->lng);

        // return $this->getBuses($graphResults);
    }

    /**
     * Get the nearest bus located by using latitude and longitude.
     *
     * @param  float $lat
     * @param  float $lng
     * @return Daison\BusRouterSg\Models\BusStop
     */
    public function getNearestBus($lat, $lng)
    {
        $builder = Models\BusStop::orderBy('distance', 'asc');

        $distance = strtr('(
                6371 /** 6371 is kilometers distance value **/
                * acos(
                    cos( radians( bus_stops.lat ) /** end radians **/ ) /** end cos **/
                    * cos( radians( {lat} ) /** end radians **/ ) /** end cos **/
                    * cos( radians( {lng} ) - radians( bus_stops.lng ) /** end radians **/ ) /** end cos **/
                    + sin( radians( bus_stops.lat ) /** end radians **/ ) /** end sin **/
                    * sin( radians( {lat} ) /** end radians **/ ) /** end cos **/
                ) /** end acos **/
            ) as distance', [
                '{lat}' => $lat,
                '{lng}' => $lng,
            ]);
        $builder->addSelect(\DB::raw($distance));

        $builder->addSelect('name');
        $builder->addSelect('bus_station_code');
        $builder->addSelect('lat');
        $builder->addSelect('lng');

        return $builder;
    }

    /**
     * Filter best buses to ride.
     *
     * @TODO combine all routes and find the best buses to take
     * @param  Hrgruri\Dijkstra\Graph $routes
     * @return array
     */
    public function getBuses($routes)
    {
        $routeBuses = [];

        # we need to know which buses belongs to each graph
        foreach ($routes as $idx => $route) {
            $explodedRoute = explode(':', $route);

            $routeBuses[$route] = (clone $this->getBuilder())
                ->where('lat', $explodedRoute[0])
                ->where('lng', $explodedRoute[1])
                ->get()->pluck('bus_number')->all();
        }

        return $routeBuses;

        // $routeBuses = collect($routeBuses)->values()->all();
        //
        // return $routeBuses;

        // $scores = [];
        //
        // for ($i = 0; $i < count($routeBuses); $i++) {
        //     $buses = $routeBuses[$i];
        //
        //     if (! isset($routeBuses[$i+1])) {
        //         continue;
        //     }
        //
        //     $busesToCompare = $routeBuses[$i+1];
        //
        //     // foreach ($buses as $bus) {
        //     //     if (in_array($bus, $busesToCompare) !== false) {
        //     //         $scores[$bus] = isset($scores[$bus]) ? $scores[$bus] + 1 : 1;
        //     //     } else {
        //     //         break 2;
        //     //     }
        //     // }
        // }
    }
}
