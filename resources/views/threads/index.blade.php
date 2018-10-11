@extends('layouts.master')

@section('content')
    <div class="h-2 bg-indigo-dark"></div>
    <div class="container mx-auto px-8 py-4">
        @include('threads.partials._nav')

        <div class="flex -mx-4">
            @include('threads.partials._sidebar')

            <div class="w-3/4 mx-4">
                <div class="bg-white rounded shadow">
                        <div class="border-b border-grey-lighter px-8 py-4 font-bold text-grey-darkest text-2xl">
                            Forum Threads
                        </div>

                        <div class="px-8 py-4">
                            @foreach($threads as $thread)
                                <article class="leading-normal tracking-normal pb-4 border-b mb-5">
                                    <div class="flex justify-between items-center">
                                        <h4 class="text-xl mb-1"><a href="{{ $thread->path() }}" class="no-underline text-indigo active:text-indigo hover:text-indigo-darker hover:underline">{{ $thread->title }}</a></h4>
                                        <div class="text-indigo flex items-center">
                                            <svg class="w-4 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><path d="M28.5 5.1c-2.2 1-5.7 3.7-7.7 5.9-2.1 2.2-4.2 4-4.8 4-2 0-9.3 7.6-11.1 11.5-2.7 6-2.5 15.9.4 21.8l2.4 4.6-2.4 2.2C4.1 56.4 3 58.2 3 59.2 3 60.9 4.1 61 18.3 61c16.9 0 20.6-1 26.1-6.9 2.9-3 3.3-3.1 11.3-3.1 9.3 0 10-.7 5.6-5.2L58.6 43l2.3-4c2.8-4.9 3.7-13.1 2.2-18.7C61.5 14.5 56.3 8.1 51 5.4c-6-3.1-16.7-3.2-22.5-.3zm6.3 12.5c14.1 5.8 17.6 24.3 6.6 34.6-5 4.7-9.2 5.8-22 5.8H7.7l2.3-2.5c2-2.2 2.2-2.9 1.2-4.3-3-4.1-5.2-10-5.2-14-.1-14.7 15.4-25.3 28.8-19.6z"/></svg>
                                            <span class="ml-2">{{ $thread->replies_count }}</span>
                                        </div>
                                    </div>
                                    <p class="text-base text-grey-dark">{{ $thread->body }}</p>
                                </article>
                            @endforeach
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
