<?php

namespace Daison\BusRouterSg\Models;

use Illuminate\Database\Eloquent\Model;

class BusService extends Model
{
    const TYPE_TRUNK = 'trunk_bus_services';
    const TYPE_FEEDER = 'feeder_bus_services';
    const TYPE_NITE = 'nite_bus_services';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'type',
        'bus_id',
        'routes',
        'operator',
        'name',
    ];
}
