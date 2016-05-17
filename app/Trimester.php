<?php
namespace Omega;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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

    public static function current($trimester = NULL)
    {
        if ($trimester !== NULL) {
            if (is_object($trimester)) {
                $trimester = $trimester->id;
            }

            Cache::forever('current_trimester', $trimester);
        }

        return Trimester::find(Cache::get('current_trimester'));
    }

    public function getIsCurrentAttribute()
    {
        return get_current_trimester_id() === $this->id;
    }

    public function scopeSetAsCurrent()
    {
        return static::current($this);
    }
}
