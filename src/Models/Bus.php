<?php

namespace Daison\BusRouterSg\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'buses';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'bus_number',
    ];

    /**
     * A bus belongs to many bus stops.
     *
     * @return mixed
     */
    public function stops()
    {
        return $this->belongsToMany(BusStop::class, 'bus_routes', 'bus_id', 'bus_stop_id')
            ->orderBy('bus_station_code', 'asc')
            ->withPivot('route');
    }
}
