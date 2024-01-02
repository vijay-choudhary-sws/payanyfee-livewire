<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InputType extends Model
{
    protected $table = 'input_types';
    protected $fillable = [
        'type','text','inputKey'
    ];

   

    public function inputMeta(): HasMany
    {
        return $this->hasMany(InputMeta::class);
    }
}
