<?php
namespace Omega;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = 'course_number';

    public $incrementing = false;

    protected $fillable = [
        'course_number', 'course_name', 'credit',
    ];

    public function courseClasses()
    {
        return $this->hasMany('Omega\CourseClass');
    }
}
