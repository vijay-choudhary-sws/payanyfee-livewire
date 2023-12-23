<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class paymenttypeconfrences extends Model
{
    protected $table = 'paymenttypeconfrences';
    protected $fillable = [
        'name','price'
    ];
}
