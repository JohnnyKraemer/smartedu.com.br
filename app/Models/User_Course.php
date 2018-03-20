<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Course extends Model
{
    protected $table = 'user_course';
    //protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id', 
        'course_id'
    ];
}
