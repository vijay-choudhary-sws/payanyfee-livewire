<?php

namespace App\Models;

    
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Multioption extends Model
{
 

    protected $table = 'multioptions';
    protected $fillable = [
      'multioptionname','multioptionlabel','input_meta_id'
    ];

   
    
}
