<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 * Page model for shop pages.
 */
class Page extends Model
{
    protected $fillable = [
        'title',
        'content',
    ];

    /**
     * Get page object by page_id.
     *
     * @param $query
     * @param $page_id
     * @return mixed
     */
    public function scopeGetPage($query, $page_id)
    {
        return $query->where('page_id', '=', $page_id)->get();
    }
}
