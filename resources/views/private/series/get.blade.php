@extends('private.base')

@section('title')
    {{ $series->title }}
@endsection

@section('main')
    <div class="w-full bg-cover" style="background-image: url('{{ $series->image_url }}')">
        <div class="backdrop-blur bg-black/20">
            <div class="w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-white">
                    Series
                </div>
                <h1 class="text-5xl py-6 font-bold font-serif text-rose-500">
                    {{ \Illuminate\Support\Str::title($series->title) }}
                </h1>
                <p class="text-2xl text-gray-100 py-3">{{ $series->description }}</p>
                <div class="flex items-center gap-x-8 mt-10">
                    <a href="{{ route('series.post', [$series, $posts->first()]) }}"
                       class="px-8 py-4 rounded-lg text-lg text-white bg-gradient-to-r from-pink-500 to-orange-500 hover:to-orange-400">
                        Start Watching
                    </a>
                    <div class="text-gray-100">
                        {{ $posts->count() }} videos
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full bg-gray-200 dark:bg-gray-800 px-6 py-16 lg:py-20">
        <div class="w-full max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
            @foreach($posts as $post)
                <div class="bg-white dark:bg-gray-700 px-4 py-4 lg:px-6 lg:py-6 rounded-md shadow-lg">
                    <div class="flex">
                        <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}" class="h-24 rounded ">

                        <div class="px-4 lg:px-6">
                            <div>
                                <span class="text-orange-400 px-1 font-bold rounded">
                                    {{ $loop->iteration }}#
                                </span>
                                <a href="{{ route('series.post', [$series, $post]) }}" class="text-lg text-red-600 dark:text-gray-200 hover:text-orange-500 dark:hover:text-rose-500 font-bold">
                                    {{ $post->title }}
                                </a>
                            </div>
                            <div class="text-gray-500 dark:text-gray-300 py-2 text-sm">
                                {{ Str::substr($post->about, 0, 100) }} ...
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
