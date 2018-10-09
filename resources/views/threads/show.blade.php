@extends('layouts.master')

@section('content')
    <div class="h-2 bg-indigo-dark"></div>
    <div class="container mx-auto px-8 py-4">
        @include('threads.partials._nav')

        <div class="max-w-md mx-auto">
            <div class="bg-white rounded shadow">
                <div class="border-b border-grey-lighter px-8 py-4 font-bold text-grey-darkest text-2xl">
                    <a href="#" class="no-underline text-indigo hover:text-indigo-darker active:text-indigo hover:underline">{{ $thread->creator->name }}</a> posted:
                    {{ $thread->title }}
                </div>

                <div class="px-8 py-4">
                    <p class="text-base text-grey-dark leading-normal tracking-normal">{{ $thread->body }}</p>
                </div>
            </div>
        </div>

        <div class="my-6">
            @foreach($thread->replies as $reply)
                <div class="max-w-md mx-auto mb-4">
                    <div class="bg-white rounded shadow">
                        <div class="border-b border-grey-lighter px-8 py-4 text-grey-darkest text-base">
                            <a href="#" class="no-underline text-indigo hover:text-indigo-darker active:text-indigo hover:underline">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}...
                        </div>

                        <div class="px-8 py-4">
                            <p class="text-base text-grey-dark leading-normal tracking-normal">{{ $reply->body }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @auth
            <div class="my-6">
                <div class="max-w-md mx-auto mb-4">
                    <div class="bg-white rounded shadow">
                        <form action="{{ $thread->path().'/replies' }}" method="post" class="flex flex-col">
                            @csrf
                            <textarea name="body" class="text-grey-darkest flex-1 p-6 resize-none rounded" placeholder="Have something to say?" rows="5"></textarea>
                            <button type="submit" class="p-4 bg-indigo text-white">Post</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center">Please <a class="no-underline text-indigo hover:text-indigo-darker active:text-indigo hover:underline" href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
        @endauth
    </div>
@endsection
