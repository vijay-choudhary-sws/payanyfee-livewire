<?php

namespace App\Models;

    
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dependencymeta extends Model
{
 

    protected $table = 'dependency_metas';
    protected $fillable = [
      'dependency_value','dependency_option'
    ];

   
    
}
