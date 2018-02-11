<?php

namespace Daison\BusRouterSg\Models;

use Illuminate\Database\Eloquent\Model;

class BusStop extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'bus_station_code',
        'lat',
        'lng',
        'name',
    ];

    /**
     * A bus stop belongs to many buses.
     *
     * @return mixed
     */
    public function buses()
    {
        return $this->belongsToMany(Bus::class, 'bus_routes', 'bus_stop_id', 'bus_id');
    }
}
