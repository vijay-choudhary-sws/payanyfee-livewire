<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Paymentsetting extends Model
{
    use HasFactory,Sluggable;

    protected $fillable = [
        'title','slug','status','amount_type','fixed_amount'
    ];
   
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

}
