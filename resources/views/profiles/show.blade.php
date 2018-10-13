@extends('layouts.master')

@section('content')
    <div class="h-2 bg-indigo-dark"></div>
    <div class="container mx-auto px-8 py-4">
        <nav class="flex justify-between items-center py-2 px-4 border-b border-grey-light mb-10">
            <div class="mr-6">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo hover:text-indigo-dark no-underline">
                    Laravel
                </a>
            </div>

            <div>
                <ul class="list-reset">
                    <li>
                        <a href="{{ route('logout') }}" class="text-base no-underline text-grey-darker hover:text-grey-darkest" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="mb-8">
            <h1 class="text-4xl text-grey-darker font-normal pb-6 border-b-2">
                {{ $profileUser->name }}
                <small class="ml-1 text-base">Since {{ $profileUser->created_at->diffForHumans() }}</small>
            </h1>
        </div>

        @foreach($threads as $thread)
            <div class="max-w-xl mx-auto">
                <div class="bg-white rounded shadow">
                    <div class="flex border-b border-grey-lighter py-8 px-8 text-grey-darkest font-semibold text-lg tracking-wide uppercase">
                        <div class="flex-1">
                            <a href="/profiles/{{ $thread->creator->name }}" class="no-underline text-indigo hover:text-indigo-darker active:text-indigo hover:underline">{{ $thread->creator->name }}</a> posted:
                            {{ $thread->title }}
                        </div>
                        <span class="text-sm font-normal">{{ $thread->created_at->diffForHumans() }}</span>
                    </div>

                    <div class="px-8 py-8">
                        <p class="text-base text-grey-dark leading-normal tracking-normal">{{ $thread->body }}</p>
                    </div>
                </div>
            </div>
        @endforeach

        {{ $threads->links('threads.partials._pagination') }}
    </div>
@endsection
