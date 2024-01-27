<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMeta extends Model
{
    protected $table = 'payment_metas';
    protected $fillable = [
        'paymentsetting_id','payment_id','meta_name','meta_value',
    ];

    public function inputMeta(){
       return $this->belongsTo(InputMeta::class,'meta_name');
    }
    
    public function paymentMetaMultiple()
    {
        return $this->hasMany(PaymentMetaMultiple::class);
    }
    public function freeho(){
        return $this->belongsTo(Posts::class,'meta_value');
     }

}
