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
}
