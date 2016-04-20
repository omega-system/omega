<?php
namespace Omega;

use Illuminate\Database\Eloquent\Model;

class CourseClassTime extends Model
{
    protected $table = 'course_class_timetable';

    protected $fillable = [
        'course_class_id', 'day', 'sequence'
    ];

    public function courseClass()
    {
        return $this->belongsTo('Omega\CourseClass');
    }
}
