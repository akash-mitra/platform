<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Post;
use App\Models\Series;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create();

        // create 5 series
        $series = Series::factory()->count(5)->create();

        // create 20 posts
        $posts = Post::factory(['user_id' => $user->id])->count(20)->create();

        // randomly attach 6 posts to each series
        foreach ($series as $s) {
            $randomPosts = $posts->random(6);
            $seriesPostOrders = [];
            foreach ($randomPosts as $p) {
                $order = $seriesPostOrders[$s->title] ?? 0;
                $s->posts()->attach($p, ['order' => $order + 1]);
                $seriesPostOrders[$s->title] = $order + 1;
            }
        }

        // create 50 contents and attach them to the above posts
        $contents = Content::factory()->count(50)->create();
        foreach ($contents as $content) {
            $content->post()->associate($posts->random());
            $content->save();
        }

        // create 15 tags and attach them to 20 posts
        $tags = Tag::factory()->count(15)->create();
        foreach ($posts as $post) {
            $post->tags()->attach($tags->random(3));
        }

    }

    private function getUnsplashImageUrls(string $query, int $count)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.unsplash.com/photos/random', [
            'query' => [
                'query' => $query,
                'count' => $count,
                'client_id' => env('UNSPLASH_ACCESS_KEY'),
                'orientation' => 'landscape',
            ],
        ]);
        $response = json_decode($response->getBody()->getContents(), true);
        return collect(array_map(fn($item) => $item['urls']['regular'], $response));
    }
}
