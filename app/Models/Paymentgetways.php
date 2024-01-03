<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paymentgetways extends Model
{
    protected $table = 'paymentgetways';
    protected $fillable = [
        'name','selectpaymentcountry','photo','status'
    ];

    public function gatewayMeta(){
        return $this->hasMany(GatewayMeta::class,'getway_id');
    }
}
