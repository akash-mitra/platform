<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Series extends Model
{
    use HasFactory;

    // series has many subjects
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }
}
