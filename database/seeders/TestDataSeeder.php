<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Post;
use App\Models\Series;
use App\Models\Subject;
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

        // create 5 subjects and attach them to the above series
        $subjects = Subject::factory()->count(5)->create();
        foreach ($subjects as $subject) {
            $subject->series()->attach($series->random());
        }

        // create 20 posts and attach them to the above subjects
        $subjectPostOrderMap = [];
        $posts = Post::factory([
            'user_id' => $user->id,
        ])->count(20)->create();

        foreach ($posts as $post) {
            // get a random subject
            $sub = $subjects->random();

            // get the order of the last post for this subject
            $order = $subjectPostOrderMap[$sub->id] ?? 0;

            // assign the post to this subject and set the order
            $post->order = $order + 1;
            $post->subject()->associate($sub);
            $post->save();

            // update post order for this subject
            $subjectPostOrderMap[$sub->id] = $order + 1;
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
}
