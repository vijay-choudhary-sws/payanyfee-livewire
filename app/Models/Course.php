<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'course_name','course_fee','total_sets','available_sets','description','status'
    ];
}
