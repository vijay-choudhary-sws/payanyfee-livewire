<?php

namespace App\Models;

    
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paymentmetamultiples extends Model
{

    protected $table = 'payment_meta_multiples';
    protected $fillable = [
      'payment_meta_id','meta_value'
    ];

    public function post()
    {
        return $this->belongsTo(Posts::class);
    }

   
    
}
