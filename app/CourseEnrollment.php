<?php
namespace Omega;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CourseEnrollment extends Model
{
    protected $primaryKey = ['user_id', 'course_class_id'];

    public $incrementing = false;

    protected $fillable = [
        'user_id', 'course_class_id', 'score_a', 'score_b'
    ];

    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('user_id', '=', $this->user_id)
            ->where('course_class_id', '=', $this->course_class_id);

        return $query;
    }

    public function student()
    {
        return $this->belongsTo('Omega\User', 'user_id');
    }

    public function courseClass()
    {
        return $this->belongsTo('Omega\CourseClass');
    }
}
