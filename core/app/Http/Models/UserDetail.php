<?php

namespace App\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'name',
        'dob',
        'phone',
    ];

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function scopeGetId($query, $profile_id)
    {
        return $query->select('id')->where('profile_id', '=', $profile_id)->get();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
