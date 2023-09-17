<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Series;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
//    public function get(Post $post) {
//        return $this->getPost($post, null);
//    }
//
//    public function getSeriesPost($slug, Post $post) {
//        $series = Series::where('slug', $slug)->first();
//        return $this->getPost($post, $series);
//    }

//    private function getPost(Post $post, $series)
//    {
//        abort_if(!$post->is_published, 404, 'Post is not published');
//
//        $videoUsage = auth()->check()
//            ? DB::table('post_user')
//                ->where('post_id', $post->id)
//                ->where('user_id', auth()->id())
//                ->select(['is_liked', 'is_disliked', 'is_favorite'])
//                ->first()
//            : null;
//
//        return view('private.page', [
//            'post' => $post,
//            'newPosts' => Post::where('id', '!=', $post->id)
//                ->where('created_at', '>', now()->subDays(30))
//                ->where('is_published', true)
//                ->latest()->take(3)->get(),
//            'series' => $series,
//            'videoUsage' => $videoUsage ?? ["is_liked" => false, "is_disliked" => false, "is_favorite" => false],
//        ]);
//    }
}
