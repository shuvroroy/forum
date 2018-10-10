@extends('layouts.master')

@section('content')
    <div class="h-2 bg-indigo-dark"></div>
    <div class="container mx-auto px-8 py-4">
        @include('threads.partials._nav')

        <div class="max-w-md mx-auto">
            <div class="bg-white rounded shadow">
                <div class="border-b border-grey-lighter px-8 py-4 font-bold text-grey-darkest text-2xl">
                    Create a Thread
                </div>

                <div class="px-8 py-4">
                    @if(count($errors))
                        @foreach($errors->all() as $error)
                            <div class="bg-red-lightest border-l-4 border-red text-red-dark p-4 rounded mb-6" role="alert">
                                <p class="font-bold">{{ $error }}</p>
                            </div>
                        @endforeach
                    @endif
                    <form action="/threads" method="post">
                        @csrf
                        <div class="mb-8">
                            <label for="title" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                Title
                            </label>

                            <input type="text" name="title" id="title" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded p-3 focus:outline-none focus:border-indigo-dark" value="{{ old('title') }}" required autofocus>
                        </div>

                        <div class="mb-8">
                            <label for="channel_id" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                Choose a Channel
                            </label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-dark" id="channel_id" name="channel_id" required>
                                    <option value="">Choose One...</option>
                                    @foreach(\App\Models\Channel::all() as $channel)
                                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label for="body" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                Body
                            </label>

                            <textarea name="body" id="body" rows="8" class="appearance-none block w-full bg-grey-lighter text-grey-darker resize-none border border-grey-lighter rounded p-3 focus:outline-none focus:border-indigo-dark" required>{{ old('body') }}</textarea>
                        </div>

                        <div class="mb-2">
                            <button type="submit" class="bg-indigo text-white px-6 py-3 rounded">Publish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
