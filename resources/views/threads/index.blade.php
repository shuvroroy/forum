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
                                    <div class="flex items-center">
                                        <h4 class="flex-1 text-xl mb-1"><a href="{{ $thread->path() }}" class="no-underline text-indigo active:text-indigo hover:text-indigo-darker hover:underline">{{ $thread->title }}</a></h4>
                                        <div class="text-indigo flex items-center">
                                            <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z"/></svg>
                                            <span class="block ml-1 text-base">{{ $thread->replies_count }}</span>
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
