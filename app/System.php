<?php
namespace Omega;

use Illuminate\Support\Facades\Cache;

class System
{
    public function allowEnrollment($value = null)
    {
        if ($value !== null) {
            Cache::forever('allow_enrollment', $value);
        }

        return Cache::get('allow_enrollment');
    }

    public function allowWithdrawal($value = null)
    {
        if ($value !== null) {
            Cache::forever('allow_withdrawal', $value);
        }

        return Cache::get('allow_withdrawal');
    }

    public function allowScoreUpdate($value = null)
    {
        if ($value !== null) {
            Cache::forever('allow_score_update', $value);
        }

        return Cache::get('allow_score_update');
    }
}
