<?php

namespace App\Models;

    
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InputMeta extends Model
{
 

    protected $table = 'input_metas';
    protected $fillable = [
        'label','select_type','paymentsetting_id','input_type_id','input_name','placeholder','is_required','order_by','is_custom','input_select_data'
    ];

   

    public function inputType(): BelongsTo
    {
        return $this->belongsTo(InputType::class);
    }

    public function metaOption()
    {
        return $this->hasMany(MetaOption::class);
    }

    public function existingSelect()
    {
        return $this->belongsTo(Inputselectdata::class,'input_select_data');
    }
}
