<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GatewayMeta extends Model
{
    protected $table = 'gateway_metas';
    protected $fillable = [
        'getway_id','payment_mode_id','amount','is_percent','status',
    ];
}
