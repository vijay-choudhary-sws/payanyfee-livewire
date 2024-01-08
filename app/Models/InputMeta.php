<?php

namespace App\Models;

    
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InputMeta extends Model
{
 

    protected $table = 'input_metas';
    protected $fillable = [
        'label','select_type','paymentsetting_id','input_type_id','input_name','placeholder','is_required','order_by'
    ];

   

    public function inputType(): BelongsTo
    {
        return $this->belongsTo(InputType::class);
    }

    public function metaOption()
    {
        return $this->hasMany(MetaOption::class);
    }

    
}
