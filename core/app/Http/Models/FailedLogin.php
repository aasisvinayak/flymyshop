<?php

namespace App\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FailedLogin
 * TODO: can be removed as the application is now using Laravel's builtin throttle check
 *
 * @package App\Http\Models
 */
class FailedLogin extends Model
{
    protected $fillable = [
        'email',
        'ip',
        'attempted_at',
    ];

    /**
     * Check how many times the IP has been added to the db in the last 10 minutes
     *
     * @param $query
     * @param $email
     * @param $ip
     * @return mixed
     */
    public static function scopeThrottle($query, $email, $ip)
    {
        $period = Carbon::now()->subMinutes(10);
        $count = $query->where('attempted_at', '>', $period)
            ->where('email', '=', $email)
            ->where('ip', '=', $ip);

        return $count;
    }
}
