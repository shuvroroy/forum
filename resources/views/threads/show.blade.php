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

        <div class="max-w-md mx-auto">
            <div class="bg-white rounded shadow">
                <div class="border-b border-grey-lighter px-8 py-4 font-bold text-grey-darkest text-2xl">
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
                            <p class="text-base text-grey-dark leading-normal tracking-normal">{{ $thread->body }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
