@extends('layouts.master')

@section('content')
    <div class="h-2 bg-indigo-dark"></div>
    <div class="container mx-auto px-8 py-4">
        @include('threads.partials._nav')

        <div class="max-w-md mx-auto">
            <div class="bg-white rounded shadow">
                <div class="border-b border-grey-lighter px-8 py-4 font-bold text-grey-darkest text-2xl">
                    Forum Threads
                </div>

                <div class="px-8 py-4">
                    @foreach($threads as $thread)
                        <article class="leading-normal tracking-normal mb-5">
                            <h4 class="text-xl mb-1"><a href="{{ $thread->path() }}" class="no-underline text-indigo active:text-indigo hover:text-indigo-darker hover:underline">{{ $thread->title }}</a></h4>
                            <p class="text-base text-grey-dark">{{ $thread->body }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
