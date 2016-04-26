<?php
namespace Omega;

use Illuminate\Database\Eloquent\Model;

class Trimester extends Model
{
    protected $fillable = [
        'year', 'sequence', 'trimester_name',
    ];

    public function courseClasses()
    {
        return $this->hasMany('Omega\CourseClass');
    }

    public function scopeAllDesc()
    {
        return $this
            ->orderBy('year', 'desc')
            ->orderBy('sequence', 'desc')
            ->get();
    }
}
