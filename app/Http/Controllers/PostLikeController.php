<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function like(Post $post)
    {
        return $post->like();
    }

    public function unlike(Post $post)
    {
        return $post->unlike();
    }

    public function dislike(Post $post)
    {
        return $post->dislike();
    }

    public function undislike(Post $post)
    {
        return $post->undislike();
    }
}
