<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use App\Models\Shipment;


class Status extends Model
{
    protected $table  = 'status';

    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class, 'status_id', 'id');
    }
}
