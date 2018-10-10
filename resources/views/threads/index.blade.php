@extends('layouts.master')

@section('content')
    <div class="h-2 bg-indigo-dark"></div>
    <div class="container mx-auto px-8 py-4">
        @include('threads.partials._nav')

        <div class="flex -mx-4">
            <div class="w-1/4 mx-4">
                <div class="mb-8">
                    <a href="/threads/create" class="block bg-indigo py-3 px-4 text-center text-bold text-white rounded hover:bg-indigo-dark">Create Thread</a>
                </div>
                <div>
                    <h3 class="text-grey-darker text-xs uppercase tracking-wide mb-2">Channels</h3>
                    <a href="/threads" class="block no-underline px-3 py-2 text-base text-grey-dark mb-1 {{ Request::is('threads') ? 'bg-white border-l-4 border-indigo rounded' : '' }}">All</a>
                    @foreach(\App\Models\Channel::all() as $channel)
                        <a href="/threads/{{ $channel->slug }}" class='block no-underline px-3 py-2 text-base text-grey-dark mb-1 {{ Request::is("threads/$channel->slug") ? "bg-white border-l-4 border-indigo rounded" : "" }}'>{{ $channel->name }}</a>
                    @endforeach
                </div>

            </div>
            <div class="w-3/4 mx-4">
                <div class="bg-white rounded shadow">
                        <div class="border-b border-grey-lighter px-8 py-4 font-bold text-grey-darkest text-2xl">
                            Forum Threads
                        </div>

                        <div class="px-8 py-4">
                            @foreach($threads as $thread)
                                <article class="leading-normal tracking-normal pb-4 border-b mb-5">
                                    <h4 class="text-xl mb-1"><a href="{{ $thread->path() }}" class="no-underline text-indigo active:text-indigo hover:text-indigo-darker hover:underline">{{ $thread->title }}</a></h4>
                                    <p class="text-base text-grey-dark">{{ $thread->body }}</p>
                                </article>
                            @endforeach
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
