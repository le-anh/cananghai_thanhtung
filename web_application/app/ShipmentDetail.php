<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentDetail extends Model
{
    protected $table = 'commodityparceldetail';

    public function shipment()
    {
        return $this->belongsTo('App\shippment', 'commodityparcel_id');
    }
}
