<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =[
        'category_id',
        'title',
        'parent_id',
        'status',
    ];


    public function scopeGetInfo($query,$slug)
    {
       return $query->where('category_id', '=', $slug);
    }


    public function products()
    {
        return $this->hasMany('App\Http\Models\Product');
    }


    /**
     * Scope a query to only include users of a given type.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
//    public function scopeOfType($query, $type)
//    {
//        return $query->where('type', $type);
//    }
}
