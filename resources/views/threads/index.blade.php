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
                    Forum Threads
                </div>

                <div class="px-8 py-4">
                    @foreach($threads as $thread)
                        <article class="leading-normal tracking-normal mb-5">
                            <h4 class="text-xl mb-1"><a href="{{ $thread->path() }}" class="no-underline text-grey-darkest hover:text-black hover:underline">{{ $thread->title }}</a></h4>
                            <p class="text-base text-grey-dark">{{ $thread->body }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
