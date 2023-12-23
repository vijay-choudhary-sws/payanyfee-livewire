<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelectDatas extends Model
{
    protected $table = 'selectdatas';
    protected $fillable = [
        'select_title'
    ];
}
