<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QrCodeParcel extends Model
{
    protected $table = 'qrcodebarparcel';

    public function qrcode()
    {
        return $this->hasMany('App\QrCode', 'qrcodebarparcel_id');
    }
}
