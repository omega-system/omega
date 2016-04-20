<?php
namespace Omega;

use Illuminate\Database\Eloquent\Model;

class CourseClass extends Model
{
    protected $fillable = [
        'trimester_id', 'course_number', 'class_number', 'user_id', 'location'
    ];

    public function trimester()
    {
        return $this->belongsTo('Omega\Trimester');
    }

    public function course()
    {
        return $this->belongsTo('Omega\Course');
    }

    public function teacher()
    {
        return $this->belongsTo('Omega\User', 'teacher_id');
    }

    public function enrollments()
    {
        return $this->hasMany('Omega\CourseEnrollment');
    }

    public function timetable()
    {
        return $this->hasMany('Omega\CourseClassTime');
    }
}
