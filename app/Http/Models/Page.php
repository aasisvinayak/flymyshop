<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $fillable=[
      "title",
        "content",
    ];

    public function scopeGetPage($query,$page_id)
    {
        return $query->where('page_id','=',$page_id)->get();

    }

}
