<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'paymentsetting_id','amount','payment_status',
    ];

    public function paymentMeta()
    {
        return $this->hasMany(PaymentMeta::class);
    }
   
}
