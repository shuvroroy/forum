@extends('layouts.master')

@section('content')
    <div class="h-2 bg-indigo-dark"></div>
    <div class="container mx-auto px-8 py-4">
        @include('threads.partials._nav')

        <div class="flex -mx-4">
            <div class="w-1/4 mx-4">
                <div class="mb-8">
                    <a href="/threads/create" class="block bg-indigo py-3 px-4 text-center no-underline text-bold text-white rounded hover:underline hover:bg-indigo-dark">Create Thread</a>
                </div>
                <div>
                    <h3 class="text-grey-darker text-xs uppercase tracking-wide mb-2">Channels</h3>
                    <a href="/threads" class="block no-underline px-3 py-2 text-base text-grey-dark mb-1 {{ Request::is('threads') ? 'bg-white border-l-4 border-indigo rounded' : '' }}">All</a>
                    @foreach($channels as $channel)
                        <a href="/threads/{{ $channel->slug }}" class='block no-underline px-3 py-2 text-base text-grey-dark mb-1 {{ Request::is("threads/$channel->slug") ? "bg-white border-l-4 border-indigo rounded" : "" }}'>{{ $channel->name }}</a>
                    @endforeach
                </div>
            </div>

            <div class="w-3/4 mx-4">
                <div class="bg-white rounded shadow">
                    <div class="border-b border-grey-lighter px-8 py-4 font-bold text-grey-darkest text-2xl">
                        <a href="#" class="no-underline text-indigo hover:text-indigo-darker active:text-indigo hover:underline">{{ $thread->creator->name }}</a> posted:
                        {{ $thread->title }}
                    </div>

                    <div class="px-8 py-4">
                        <p class="text-base text-grey-dark leading-normal tracking-normal">{{ $thread->body }}</p>
                    </div>
                </div>

                <div class="my-6">
                    @foreach($thread->replies as $reply)
                        <div class="mb-4">
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
