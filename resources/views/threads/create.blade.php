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
                    <form action="/threads" method="post">
                        @csrf
                        <div class="mb-8">
                            <label for="title" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                Title
                            </label>

                            <input type="text" name="title" id="title" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded p-3 focus:outline-none focus:border-indigo-dark" required autofocus>
                        </div>

                        <div class="mb-8">
                            <label for="body" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                Body
                            </label>

                            <textarea name="body" id="body" rows="8" class="appearance-none block w-full bg-grey-lighter text-grey-darker resize-none border border-grey-lighter rounded p-3 focus:outline-none focus:border-indigo-dark" required></textarea>
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
