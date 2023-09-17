<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Series;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index()
    {
        return view('private.series.index', [
            'series' => Series::all(),
        ]);
    }
    public function get(Series $series)
    {
        return view('private.series.get', [
            'series' => $series,
            'posts' => $series->posts()
                ->where('is_published', true)
                ->orderBy('order')
                ->get(),
        ]);
    }

    public function getPost(Series $series, Post $post) {
        abort_if(!$post->is_published, 404, 'This Post is not published');

        $videoUsage = auth()->check()
            ? DB::table('post_user')
                ->where('post_id', $post->id)
                ->where('user_id', auth()->id())
                ->select(['is_liked', 'is_disliked', 'is_favorite'])
                ->first()
            : null;

        $seriesPosts = $series->posts()
            ->where('is_published', '=', true)
            ->orderByPivot('order')
            ->get();

        $currentOrder = $seriesPosts->filter(fn ($p) => $p->id == $post->id)->first()->pivot->order;
        $nextPost = $seriesPosts->filter(fn ($p) => $p->pivot->order > $currentOrder)->first();
        $previousPost = $seriesPosts->filter(fn ($p) => $p->pivot->order < $currentOrder)->last();

        return view('private.page', [
            'series' => $series,
            'post' => $post,
            'newPosts' => Post::where('id', '!=', $post->id)
                ->where('created_at', '>', now()->subDays(30))
                ->where('is_published', true)
                ->latest()
                ->take(3)
                ->get(),
            'videoUsage' => $videoUsage ?? ["is_liked" => false, "is_disliked" => false, "is_favorite" => false],
            'next' => $nextPost,
            'previous' => $previousPost,
        ]);
    }
}
