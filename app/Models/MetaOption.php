<?php

namespace App\Models;

    
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MetaOption extends Model
{
 

    protected $table = 'meta_options';
    protected $fillable = [
       'option_value','input_meta_id','label','is_default'
    ];

    public function inputMeta(): BelongsTo
    {
        return $this->belongsTo(InputMeta::class);
    }
    
}
