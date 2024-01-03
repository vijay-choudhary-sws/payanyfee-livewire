<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingWithGetways extends Model
{
    protected $table = 'setting_with_getways';
    protected $fillable = [
        'paymentsetting_id', 'paymentgetway_id'
    ];

    public function getway()
    {
        return $this->belongsTo(Paymentgetways::class,'paymentgetway_id');
    }
}
