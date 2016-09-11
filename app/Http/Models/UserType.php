<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $fillable = [

    ];

    protected $casts = [
        'type' => 'string',
    ];

    public function scopeGetType($query, $user_id)
    {
        return  $query->select('type')->where('user_id', '=', $user_id)->get();
    }
}
