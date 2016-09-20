<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserType
 * UserType mode for user type
 *
 * @package App\Http\Models
 */
class UserType extends Model
{
    protected $fillable = [

    ];

    protected $casts = [
        'type' => 'string',
    ];

    /**
     * Get user type by user_id
     *
     * @param $query
     * @param $user_id
     * @return mixed
     */
    public function scopeGetType($query, $user_id)
    {
        return  $query->select('type')->where('user_id', '=', $user_id)->get();
    }
}
