<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function series()
    {
        return $this->belongsToMany(Series::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getUrlAttribute()
    {
        return route('subject', $this);
    }
}
