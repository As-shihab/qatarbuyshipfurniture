<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galaray extends Model
{
       protected $fillable = [
        'title',
        'slug',
        'description',
        'file_name',
        'status',
        'published_at',
    ];
}
