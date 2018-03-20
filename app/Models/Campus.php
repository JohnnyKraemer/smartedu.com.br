<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Campus extends Model
{
    protected $table = 'campus';

    protected $appends = ['amount_courses', 'amount_users', 'amount_students'];

    protected $fillable = [
        'id', 'name', 'city',
    ];

    public function getAmountCoursesAttribute()
    {
        return DB::table('course')->where('campus_id', $this->id)->count();
    }

    public function getAmountUsersAttribute()
    {
        return DB::table('user')->where('campus_id', $this->id)->count();
    }

    public function getAmountStudentsAttribute()
    {
        $users = DB::table('student')
            ->leftJoin('course', 'student.course_id', '=', 'course.id')
            ->leftJoin('campus', 'course.campus_id', '=', 'campus.id')
            ->select('campus.id')
            ->get()->count();

        return $users;
    }
}
