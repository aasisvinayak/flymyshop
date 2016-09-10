<?php

namespace App\Http\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class FailedLogin extends Model
{
    protected $fillable=[
        'email',
        'ip',
        'attempted_at'
    ];

    public static function scopeThrottle($query,$email,$ip)
    {
        $period    = Carbon::now()->subMinutes(10);
        $count = $query->where('attempted_at', '>', $period)
            ->where('email','=',$email)
            ->where('ip','=',$ip);
        return $count;
    }
}
