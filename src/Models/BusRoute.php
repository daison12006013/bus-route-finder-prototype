<?php

namespace Daison\BusRouterSg\Models;

use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'route',
        'bus_id',
        'bus_stop_id',
    ];
}
