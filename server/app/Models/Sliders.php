<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    protected $fillable = [
        'image',
        'title',
        'description',
        'link',
        'order',
        'is_active',
    ];
}
