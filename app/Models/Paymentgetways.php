<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paymentgetways extends Model
{
    protected $table = 'paymentgetways';
    protected $fillable = [
        'name','selectpaymentcountry','photo','status'
    ];
}
