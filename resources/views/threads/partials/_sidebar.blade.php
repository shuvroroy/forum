<div class="w-1/4 mx-4">
    <div class="mb-8">
        <a href="/threads/create" class="block bg-indigo py-3 px-4 text-center no-underline text-bold text-white rounded hover:underline hover:bg-indigo-dark">Create Thread</a>
    </div>

    <div class="mb-8">
        <h3 class="text-grey-darker text-xs uppercase tracking-wide mb-2">Choose a filter</h3>
        <a href="/threads" class="block no-underline px-3 py-2 text-base text-grey-dark mb-1 {{ Request::is('threads') && empty(Request::query()) ? 'bg-white border-l-4 border-indigo rounded' : '' }}">All Threads</a>
        @auth
            <a href="/threads?by={{ $name = auth()->user()->name }}" class="block no-underline px-3 py-2 text-base text-grey-dark mb-1 {{ request()->has('by') ? 'bg-white border-l-4 border-indigo rounded' : '' }}">My Threads</a>
        @endauth
    </div>

    <div>
        <h3 class="text-grey-darker text-xs uppercase tracking-wide mb-2">Channels</h3>
        @foreach($channels as $channel)
            <a href="/threads/{{ $channel->slug }}" class='block no-underline px-3 py-2 text-base text-grey-dark mb-1 {{ Request::is("threads/$channel->slug") ? "bg-white border-l-4 border-indigo rounded" : "" }}'>{{ $channel->name }}</a>
        @endforeach
    </div>
</div>