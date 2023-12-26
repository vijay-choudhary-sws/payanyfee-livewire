<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentsettingMeta extends Model
{
    use HasFactory;

    protected $table = 'paymentsetting_metas';

    protected $fillable = [
        'meta_key','meta_value','paymentsetting_id','metaType'
    ];
    


}
