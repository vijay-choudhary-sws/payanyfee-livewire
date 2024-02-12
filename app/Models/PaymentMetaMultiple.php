<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMetaMultiple extends Model
{
    protected $table = 'payment_meta_multiples';
    protected $fillable = [
        'payment_meta_id','meta_value',
    ];

    public function paymentMeta(){
        return $this->belongsTo(PaymentMeta::class,'payment_meta_id');
     }

     public function post(){
        return $this->belongsTo(Posts::class,'meta_value');
     }
}
