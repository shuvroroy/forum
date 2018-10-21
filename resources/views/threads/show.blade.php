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
                        <div class="flex">
                            <div class="flex-1">
                                <a href="{{ route('profile', $thread->creator) }}" class="no-underline text-indigo hover:text-indigo-darker active:text-indigo hover:underline">{{ $thread->creator->name }}</a> posted:
                                <a href="{{ $thread->path() }}"  class="no-underline text-indigo hover:text-indigo-darker active:text-indigo hover:underline">{{ $thread->title }}</a>
                            </div>
                            @can('touch', $thread)
                                <form action="{{ $thread->path() }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-xs text-red p-2 border border-red bg-red-lightest rounded focus:outline-none">Delete Thread</button>
                                </form>
                            @endcan
                        </div>
                    </div>

                    <div class="px-8 py-4">
                        <p class="text-base text-grey-dark leading-normal tracking-normal">{{ $thread->body }}</p>
                    </div>
                </div>

                <div class="my-6">
                    @foreach($replies as $reply)
                        <div class="mb-4">
                            <div class="bg-white rounded shadow">
                                <div class="border-b border-grey-lighter px-8 py-4 text-grey-darkest text-base flex justify-between items-center">
                                    <div><a href="/profiles/{{ $reply->owner->name }}" class="no-underline text-indigo hover:text-indigo-darker active:text-indigo hover:underline">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}...</div>
                                    <form action="/replies/{{ $reply->id }}/favorites" method="post">
                                        @csrf
                                        <button type="submit" class="flex items-center focus:outline-none">
                                            <svg class="w-5 h-5 {{ $reply->isFavorited() ? 'text-red' : '' }}" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 3.22l-.61-.6a5.5 5.5 0 0 0-7.78 7.77L10 18.78l8.39-8.4a5.5 5.5 0 0 0-7.78-7.77l-.61.61z"/></svg>
                                            <span class="block ml-1 text-base">{{ $reply->favorites_count }}</span>
                                        </button>
                                    </form>
                                </div>

                                <div class="px-8 py-4">
                                    <p class="text-base text-grey-dark leading-normal tracking-normal">{{ $reply->body }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $replies->links('threads.partials._pagination') }}
                </div>

                @auth
                    <div class="my-6">
                        <div class="bg-white rounded shadow">
                            <form action="{{ $thread->path().'/replies' }}" method="post" class="flex flex-col">
                                @csrf
                                <textarea name="body" class="text-grey-darkest flex-1 p-6 resize-none rounded-t border border-transparent focus:outline-none focus:border-indigo-dark" placeholder="Have something to say?" rows="5"></textarea>
                                <button type="submit" class="p-4 bg-indigo text-white rounded-b focus:outline-none focus:border-indigo-dark">Post</button>
                            </form>
                        </div>
                    </div>
                @else
                    <p class="text-center">Please <a class="no-underline text-indigo hover:text-indigo-darker active:text-indigo hover:underline" href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
                @endauth
            </div>
        </div>
    </div>
@endsection
