<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * TODO: change db schema to key => value.
 */
class Setting extends Model
{
    protected $fillable = [
        'value',
    ];

    public function scopeRow($query, $title)
    {
        return $query->select('id','title','value')
            ->where('title', '=', $title)->get();
    }
}
