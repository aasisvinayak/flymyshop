<?php

namespace App\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserDetail
 * UserDetail model for profile
 *
 * @package App\Http\Models
 */
class UserDetail extends Model
{
    protected $fillable = [
        'name',
        'dob',
        'phone',
    ];

    /**
     * Mutator for dob
     *
     * @param $value
     */
    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    /**
     * Get profile from profile_id
     *
     * @param $query
     * @param $profile_id
     * @return mixed
     */
    public function scopeGetId($query, $profile_id)
    {
        return $query->select('id')->where('profile_id', '=', $profile_id)->get();
    }

    /**
     * Each profile belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
