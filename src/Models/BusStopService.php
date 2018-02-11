<?php

namespace Daison\BusRouterSg\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @deprecated We will use bus_routes table since it has the same fields in it.
 */
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
