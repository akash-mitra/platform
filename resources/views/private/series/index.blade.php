@extends('private.base')

@section('title')
    All series
@endsection

@section('main')

<div class="relative bg-gray-50 dark:bg-gray-900 px-6 pb-20 pt-12 lg:px-8 lg:pb-28 lg:pt-16">
    <div class="absolute inset-0">
        <div class="h-1/3 bg-gray-300 dark:bg-gradient-to-r dark:from-gray-700 dark:via-gray-900 dark:to-gray-700"></div>
    </div>
    <div class="relative mx-auto max-w-7xl">
        <div class="text-center">
            <h2 class="text-3xl font-bold tracking-tight dark:text-gray-200 sm:text-4xl">Power Series 🚀</h2>
            <p class="mx-auto mt-3 max-w-2xl text-xl dark:text-gray-200 sm:mt-4">Boost your knowledge with the power packed learning Series</p>
        </div>

        <div class="mx-auto mt-12 grid max-w-lg gap-10 lg:max-w-none lg:grid-cols-3">
            @foreach($series as $s)
            <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                <div class="flex-shrink-0">
                    <img class="h-48 w-full object-cover" src="{{ $s->image_url }}" alt="">
                </div>
                <div class="flex flex-1 flex-col justify-between bg-white dark:bg-gray-800 p-6">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-indigo-600">
                            <a href="/series" class="hover:underline">Series</a>
                        </p>
                        <a href="{{ $s->url }}" class="mt-2 block">
                            <p class="text-xl font-semibold text-gray-900 dark:text-gray-300">{{ $s->title }}</p>
                            <p class="mt-3 text-base text-gray-500 dark:text-gray-400">{{ $s->description }}</p>
                        </a>
                    </div>
                    <div class="mt-6 flex items-center">
                        <div class="flex-shrink-0">
{{--                            <a href="#">--}}
{{--                                <span class="sr-only">Roel Aufderehar</span>--}}
{{--                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">--}}
{{--                            </a>--}}
                            <a href="{{ $s->url }}" class="text-white bg-gradient-to-r from-pink-500 to-orange-500 px-3 py-2 rounded-lg text-xs font-bold">Explore</a>
                        </div>
                        <div class="ml-3">
{{--                            <p class="text-sm font-medium text-gray-900">--}}
{{--                                <a href="#" class="hover:underline">Roel Aufderehar</a>--}}
{{--                            </p>--}}
                            <div class="flex space-x-1 text-sm text-gray-500">
                                <time datetime="2020-03-16">Mar 16, 2020</time>
                                <span aria-hidden="true">&middot;</span>
                                <span>{{ $s->posts->count() }} videos</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>

@endsection
