<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'paymentsetting_id','amount','status','name','email','phone',
    ];

    public function paymentMeta()
    {
        return $this->hasMany(PaymentMeta::class);
    }

    public function paymentsetting()
    {
        return $this->belongsTo(Paymentsetting::class);
    }

    public function paymentGetway()
    {
        return $this->belongsTo(Paymentgetways::class,'paymentgetway_id');
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class,'paymentmode_id');
    }



}
