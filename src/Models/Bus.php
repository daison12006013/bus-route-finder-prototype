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
}
