<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $table = 'commodityparcel';

    public function shipmentdetail()
    {
        return $this->hasMany('App\ShipmentDetail', 'commodityparcel_id');
    }
}
