<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Post extends Model
{
    use HasFactory;

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function like(): Post
    {
        DB::table('post_user')
            ->updateOrInsert(
                ['post_id' => $this->id, 'user_id' => auth()->id()],
                ['is_liked' => true, 'is_disliked' => false]
            );
        $this->likes++;
        $this->save();
        return $this;
    }

    public function unlike(): Post
    {
        DB::table('post_user')
            ->updateOrInsert(
                ['post_id' => $this->id, 'user_id' => auth()->id()],
                ['is_liked' => false, 'is_disliked' => false]
            );
        $this->likes--;
        $this->save();
        return $this;
    }

    public function dislike(): Post
    {
        DB::table('post_user')
            ->updateOrInsert(
                ['post_id' => $this->id, 'user_id' => auth()->id()],
                ['is_liked' => false, 'is_disliked' => true]
            );
        $this->likes--;
        $this->save();
        return $this;
    }

    public function undislike(): Post
    {
        DB::table('post_user')
            ->updateOrInsert(
                ['post_id' => $this->id, 'user_id' => auth()->id()],
                ['is_liked' => false, 'is_disliked' => false]
            );
        $this->likes++;
        $this->save();
        return $this;
    }

    public function getPreviousAttribute()
    {
        return Post::where('subject_id', $this->subject_id)
            ->where('order', $this->order - 1)
            ->where('is_published', true)
            ->first();
    }

    public function getNextAttribute()
    {
        return Post::where('subject_id', $this->subject_id)
            ->where('order', $this->order + 1)
            ->where('is_published', true)
            ->first();
    }


    public function getOrdinalAttribute()
    {
        $ordinal = $this->order;
        $lastDigit = substr($ordinal, -1);
        $lastTwoDigits = substr($ordinal, -2);
        if ($lastTwoDigits > 10 && $lastTwoDigits < 20) {
            return $ordinal . 'th';
        }
        if ($lastDigit == 1) {
            return $ordinal . 'st';
        }
        if ($lastDigit == 2) {
            return $ordinal . 'nd';
        }
        if ($lastDigit == 3) {
            return $ordinal . 'rd';
        }
        return $ordinal . 'th';
    }
}
