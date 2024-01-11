<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
   
    protected $table = 'posts';
    protected $fillable = [
        'title','category_id','status'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
