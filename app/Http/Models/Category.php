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
}
