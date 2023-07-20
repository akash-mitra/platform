@extends('private.stack')

@section('main')
    <div class="px-4 sm:px-0">

        <div class="">
{{--            <div class="text-gray-400 font-medium text-sm">--}}
{{--                Building your own trading bot &gt;--}}
{{--            </div>--}}
            <div class=" text-lg text-rose-500">
                12. Handling Broker Login during Back Testing
            </div>

{{--            <nav class="isolate flex divide-x divide-gray-200 rounded-lg shadow" aria-label="Tabs">--}}
{{--                <!-- Current: "text-gray-900", Default: "text-gray-500 hover:text-gray-700" -->--}}
{{--                <a href="#" aria-current="page" class="text-gray-900 rounded-l-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-6 text-center text-sm font-medium hover:bg-gray-50 focus:z-10">--}}
{{--                    <span>Recent</span>--}}
{{--                    <span aria-hidden="true" class="bg-rose-500 absolute inset-x-0 bottom-0 h-0.5"></span>--}}
{{--                </a>--}}
{{--                <a href="#" class="text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-6 text-center text-sm font-medium hover:bg-gray-50 focus:z-10">--}}
{{--                    <span>Most Liked</span>--}}
{{--                    <span aria-hidden="true" class="bg-transparent absolute inset-x-0 bottom-0 h-0.5"></span>--}}
{{--                </a>--}}
{{--                <a href="#" class="text-gray-500 hover:text-gray-700 rounded-r-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-6 text-center text-sm font-medium hover:bg-gray-50 focus:z-10">--}}
{{--                    <span>Most Answers</span>--}}
{{--                    <span aria-hidden="true" class="bg-transparent absolute inset-x-0 bottom-0 h-0.5"></span>--}}
{{--                </a>--}}
{{--            </nav>--}}
        </div>
    </div>



    <div class="mt-4">
        <h1 class="sr-only">Recent questions</h1>
        <ul role="list" class="space-y-4">

            <li>
                <iframe height="315"
                        class="w-full"
                        https://www.youtube.com/watch?v=7g0pi4J8auQ
                        src="https://www.youtube.com/embed/7g0pi4J8auQ?start=59"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                </iframe>

                <div class="my-4 bg-white rounded-lg shadow py-4 px-3 flex space-x-3">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-900">
                            <a href="#" class="hover:underline">Dries Vincent</a>
                        </p>
                        <p class="text-sm text-gray-500">
                            <a href="#" class="hover:underline">
                                <time datetime="2020-12-09T11:43:00">December 9 at 11:43 AM</time>
                            </a>
                        </p>
                    </div>
                </div>

            </li>
            <li class="bg-white px-4 py-4 shadow sm:rounded-lg sm:p-6">

                <article aria-labelledby="question-title-81614">
                    <div>
                        <h2 id="question-title-81614" class="text-base font-medium text-gray-700">How do you handle broker login if your backtesting runs automatically?</h2>
                    </div>
                    <div class="mt-2 space-y-4 text-sm text-gray-400">
                        <p>Jurassic Park was an incredible idea and a magnificent feat of engineering, but poor protocols and a disregard for human safety killed what could have otherwise been one of the best businesses of our generation.</p>
                        <p>Ultimately, I think that if you wanted to run the park successfully and keep visitors safe, the most important thing to prioritize would be&hellip;</p>
                    </div>
                    <div class="mt-6 flex justify-between space-x-8">
                        <div class="flex space-x-6">
                    <span class="inline-flex items-center text-sm">
                      <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z" />
                        </svg>
                        <span class="font-medium text-gray-900">29</span>
                        <span class="sr-only">likes</span>
                      </button>
                    </span>
                            <span class="inline-flex items-center text-sm">
                      <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 001.28.53l3.58-3.579a.78.78 0 01.527-.224 41.202 41.202 0 005.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0010 2zm0 7a1 1 0 100-2 1 1 0 000 2zM8 8a1 1 0 11-2 0 1 1 0 012 0zm5 1a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium text-gray-900">11</span>
                        <span class="sr-only">replies</span>
                      </button>
                    </span>
                            <span class="inline-flex items-center text-sm">
                      <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                          <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium text-gray-900">2.7k</span>
                        <span class="sr-only">views</span>
                      </button>
                    </span>
                        </div>
                        <div class="flex text-sm">
                    <span class="inline-flex items-center text-sm">
                      <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path d="M13 4.5a2.5 2.5 0 11.702 1.737L6.97 9.604a2.518 2.518 0 010 .792l6.733 3.367a2.5 2.5 0 11-.671 1.341l-6.733-3.367a2.5 2.5 0 110-3.475l6.733-3.366A2.52 2.52 0 0113 4.5z" />
                        </svg>
                        <span class="font-medium text-gray-900">Share</span>
                      </button>
                    </span>
                        </div>
                    </div>
                </article>
            </li>

            <!-- More questions... -->
        </ul>
    </div>
@endsection
