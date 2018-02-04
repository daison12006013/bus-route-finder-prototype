<?php

namespace Daison\BusRouterSg\Models;

use Illuminate\Database\Eloquent\Model;

class BusStopService extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'bus_stop_id',
        'bus_id',
    ];
}
