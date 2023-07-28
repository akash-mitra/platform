@extends('private.base')

@section('title')
    {{ $post->title }}
@endsection

@section('main')
<div class="mx-auto max-w-7xl grid grid-cols-5 font-sans">
    <article class="col-span-5 md:col-span-3 px-6">
        <header class="py-4 rounded-lg">
            <h1 class="font-bold font-serif text-2xl text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-orange-500 tracking-tight leading-8 pb-3">
                {{ $post->title }}
            </h1>
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-x-2">
                    <div class="bg-orange-500 text-white p-2 rounded-lg text-sm font-bold">{{ $post->ordinal }} </div>
                    <div class="dark:text-gray-400">video in </div>
                    <a href="{{ is_null($series) ? $post->subject->url : $series->url }}"
                       class="text-red-600 tracking-tight">
                        {{ is_null($series) ? $post->subject->name : $series->title }}
                    </a>
                </div>

                @if(! $post->is_premium)
                    <div class="flex items-center text-violet-600 text-sm">
                        <span class="hidden sm:inline md:hidden xl:inline p-2">
                            Premium
                        </span>
                        <div class="p-2 border border-violet-600 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                            </svg>
                        </div>
                    </div>
                @endif
            </div>
        </header>

        <div id="main-video" class="w-full">
            <iframe id="main-video-iframe"
                    class="my-2 w-full aspect-video shadow-xl rounded z-20"
                    src="{{ $post->video_url }}" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
            </iframe>
        </div>

        <div class="mt-4" x-data="videoInteractions">

            <div class="flex flex-wrap gap-y-2 gap-x-3">
                <div class="flex items-center gap-2 bg-white dark:bg-gray-800 px-2 py-2 lg:px-3 lg:py-3 rounded"
                     :class="usage.is_disliked === true ? 'text-red-500/70 cursor-not-allowed': 'shadow text-red-500 hover:bg-red-500 hover:text-white cursor-pointer'"
                     @auth @click="like()" @else @click="showLoginModal = true" @endauth>
                    <div class="text-sm hidden sm:block md:hidden lg:block" x-text="likes"></div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" :class="usage.is_liked === true ? 'fill-red-200': ''">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center gap-2 bg-white dark:bg-gray-800 px-2 py-2 lg:px-3 lg:py-3 rounded"
                     :class="usage.is_liked === true ? 'text-red-500/70 cursor-not-allowed': 'shadow text-red-500 hover:bg-red-500 hover:text-white cursor-pointer'"
                     @auth @click="dislike()" @else @click="showLoginModal = true" @endauth>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"  :class="usage.is_disliked === true ? 'fill-red-200': ''">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 15h2.25m8.024-9.75c.011.05.028.1.052.148.591 1.2.924 2.55.924 3.977a8.96 8.96 0 01-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398C20.613 14.547 19.833 15 19 15h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 00.303-.54m.023-8.25H16.48a4.5 4.5 0 01-1.423-.23l-3.114-1.04a4.5 4.5 0 00-1.423-.23H6.504c-.618 0-1.217.247-1.605.729A11.95 11.95 0 002.25 12c0 .434.023.863.068 1.285C2.427 14.306 3.346 15 4.372 15h3.126c.618 0 .991.724.725 1.282A7.471 7.471 0 007.5 19.5a2.25 2.25 0 002.25 2.25.75.75 0 00.75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 002.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384" />
                        </svg>
                    </div>
                    <div class="text-sm hidden sm:block md:hidden lg:block"></div>
                </div>
                <div class="flex items-center gap-2 bg-white dark:bg-gray-800 px-2 py-2 lg:px-3 lg:py-3 rounded shadow text-red-500 hover:bg-red-500 hover:text-white cursor-pointer">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>
                    </div>
                    <div class="text-sm hidden sm:block md:hidden lg:block">Save</div>
                </div>
                <div class="flex items-center gap-2 bg-white dark:bg-gray-800 px-2 py-2 lg:px-3 lg:py-3 rounded shadow text-red-500 hover:bg-red-500 hover:text-white cursor-pointer">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                        </svg>
                    </div>
                    <div class="text-sm hidden sm:block md:hidden lg:block">Discuss</div>
                </div>
                <div class="flex items-center gap-2 bg-white dark:bg-gray-800 px-2 py-2 lg:px-3 lg:py-3 rounded shadow text-red-500 hover:bg-red-500 hover:text-white cursor-pointer">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="text-sm hidden sm:block md:hidden lg:block">Doubt?</div>
                </div>
                <div class="flex items-center gap-2 bg-white dark:bg-gray-800 px-2 py-2 lg:px-3 lg:py-3 rounded shadow text-red-500 hover:bg-red-500 hover:text-white cursor-pointer">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                        </svg>
                    </div>
                    <div class="text-sm hidden sm:block md:hidden lg:block"></div>
                </div>
            </div>
        </div>

        @foreach($post->contents as $content)
            <div class="bg-white/50 dark:bg-gray-900 px-6 py-4 rounded-lg mt-4">
                <div class="prose prose-sm sm:prose-base md:prose-sm lg:prose-base text-gray-600 dark:text-gray-400">
                    {!! $content->html !!}

                </div>
            </div>
        @endforeach
    </article>

    <aside class="col-span-5 md:col-span-2 px-6 xl:px-8">

        @if(! is_null($post->next))
            <div class="mt-4">
                <div class="uppercase text-gray-400 text-xs py-2">Coming up next...</div>
                <div class="bg-white dark:bg-gray-800 px-2 py-3 lg:px-3 lg:py-4 rounded shadow">
                    <div class="flex">
                        <img src="{{ $post->next->thumbnail_url }}" alt="{{ $post->next->title }}"
                             class="h-20 rounded">
                        <div class="px-2 lg:px-3 flex flex-col justify-between">
                            <div class="text-gray-500 dark:text-gray-400 text-sm">{{ $post->next->title }}</div>
                            <div>
                                <a href="{{ is_null($series) ? route('post', $post->next) : route('series.post', [$series->slug, $post->next]) }}"
                                   class="inline-flex gap-x-2 items-center text-sm bg-red-500 hover:bg-orange-500 text-red-100 px-3 py-1 rounded shadow">
                                    <span>Next</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="mt-4">
                <div class="bg-white dark:bg-gray-800 px-3 py-3 lg:px-4 lg:py-4 rounded shadow flex items-center text-red-600 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mr-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                    </svg>
                    <div class="">
                        Congrats! You've reached the end of this {{ is_null($series) ? 'subject' : 'series' }}.
                    </div>
                </div>
            </div>
        @endif


        @if(! is_null($post->previous))
            <div class="mt-4">
                <div class="uppercase text-gray-400 text-xs py-2">Previously...</div>
                <div class="bg-white dark:bg-gray-800 px-2 py-3 lg:px-3 lg:py-4 rounded shadow">
                    <div class="flex">
                        <img src="{{ $post->previous->thumbnail_url }}" alt="{{ $post->previous->title }}"
                             class="h-20 rounded">
                        <div class="px-2 lg:px-3 flex flex-col justify-between">
                            <div class="text-gray-500 dark:text-gray-400 text-sm">{{ $post->previous->title }}</div>

                            <div>
                                <a href="{{ is_null($series) ? route('post', $post->previous) : route('series.post', [$series->slug, $post->previous]) }}"
                                   class="inline-flex gap-x-2 items-center text-sm bg-red-500 hover:bg-orange-500 text-red-100 px-3 py-1 rounded shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
                                    </svg>
                                    <span>Prev</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="mt-4">
            <div class="uppercase text-gray-400 text-xs py-2">About</div>
            <div class="bg-white dark:bg-gray-800 px-2 py-3 lg:px-4 lg:py-4 rounded shadow">
                <div class="text-gray-500 dark:text-gray-400">
                    {{ $post->about }}
                </div>


                <div class="mt-4 flex flex-wrap gap-4">
                    @foreach($post->tags as $tag)
                        <a href="/tags/{{ $tag->name }}"
                           class="bg-red-50 dark:bg-gray-700 hover:bg-red-100 px-3 py-1 rounded-md text-sm text-red-500 shadow border border-red-200 dark:border-gray-500">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>



        @if(count($newPosts)> 0)
            <div class="mt-4">
                <div class="uppercase text-gray-400 text-xs py-2">What's New?</div>

                @foreach($newPosts as $p)
                    <div class="mb-2 bg-white dark:bg-gray-800 px-2 py-3 lg:px-3 lg:py-4 rounded shadow">
                        <div class="flex">
                            <img src="{{ $p->thumbnail_url }}" alt="{{ $p->title }}"
                                 class="h-20 rounded">
                            <div class="px-2 lg:px-3">
                                <a href="{{ route('post', $p) }}" class="text-red-500 hover:text-orange-500 font-bold">
                                    {{ $p->title }}
                                </a>
                                <div class="text-gray-500 dark:text-gray-400 py-2 text-sm">
                                    {{ Str::substr($p->about, 0, 60) }} ...
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div>
            <div class="sm:hidden">xs</div>
            <div class="hidden sm:block md:hidden">sm</div>
            <div class="hidden md:block lg:hidden">md</div>
            <div class="hidden lg:block xl:hidden">lg</div>
            <div class="hidden xl:block">xl</div>
        </div>

    </aside>
</div>
<div class="md:fixed right-4 lg:right-6 xl:right-8 top-2 w-2/5"></div>
@endsection

@section('scripts')
    <script>
        const videoInteractions = {
            likes: {!! $post->likes !!},
            {{-- { "is_liked":true, "is_disliked":false, "is_favorite":false } --}}
            usage: {!! json_encode($videoUsage) !!},

            like() {
                if(this.usage.is_disliked) return;
                if(this.usage.is_liked) {
                    axios.post('/posts/{{ $post->id }}/unlike')
                        .then(() => { this.likes--; this.usage.is_liked = false })
                        .catch(error => console.log(error));
                } else {
                    axios.post('/posts/{{ $post->id }}/like')
                        .then(() => { this.likes++; this.usage.is_liked = true; })
                        .catch(error => console.log(error));
                }
            },
            dislike() {
                if(this.usage.is_liked) return;
                if(this.usage.is_disliked) {
                    axios.post('/posts/{{ $post->id }}/undislike')
                        .then(() => { this.likes++; this.usage.is_disliked = false })
                        .catch(error => console.log(error));
                } else {
                    axios.post('/posts/{{ $post->id }}/dislike')
                        .then(() => { this.likes--; this.usage.is_disliked = true; })
                        .catch(error => console.log(error));
                }
            }
        }
    </script>

    <script>
        const options = {root: null, threshold: 0.8}
        const callback = function(entries, observer) {
            entries.forEach((entry) => {
                const videoIFrame = document.getElementById("main-video-iframe");
                if(! entry.isIntersecting) {
                    videoIFrame.classList.remove("w-full")
                    videoIFrame.classList.add("md:fixed", "top-2", "right-4", "lg:right-6", "xl:right-8", "w-2/5");
                } else {
                    videoIFrame.classList.remove("md:fixed", "top-2", "right-4", "lg:right-6", "xl:right-8", "w-2/5");
                    videoIFrame.classList.add("w-full")
                }
            })
        }
        let observer = new IntersectionObserver(callback, options)
        const target = document.getElementById("main-video")
        observer.observe(target)
    </script>
@endsection
