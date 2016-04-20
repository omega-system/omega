<?php
namespace Omega;

use Illuminate\Database\Eloquent\Model;

class CourseEnrollment extends Model
{
    protected $fillable = [
        'user_id', 'course_class_id', 'score'
    ];

    public function courseClass()
    {
        return $this->belongsTo('Omega\CourseClass');
    }
}
