<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * Category model to store category information.
 */
class Category extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'parent_id',
        'status',
    ];

    /**
     * Get address object from category_id.
     *
     * @param $query
     * @param $slug
     * @return mixed
     */
    public function scopeGetInfo($query, $slug)
    {
        return $query->where('category_id', '=', $slug);
    }

    /**
     * Each category has many products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Http\Models\Product');
    }
}
