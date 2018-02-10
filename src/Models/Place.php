<?php

namespace Daison\BusRouterSg\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'name',
        'address',
        'postal_code',
        'lat',
        'lng',
    ];
}
