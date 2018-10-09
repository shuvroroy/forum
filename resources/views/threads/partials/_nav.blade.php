<nav class="flex justify-between items-center py-2 px-4 border-b border-grey-light mb-10">
    <div class="mr-6">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo hover:text-indigo-dark no-underline">
            Laravel
        </a>
    </div>

    <div>
        <ul class="list-reset flex">
            @auth
                <li class="mr-4">
                    <a href="/threads" class="text-base no-underline text-grey-darker hover:text-grey-darkest">All Threads</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="text-base no-underline text-grey-darker hover:text-grey-darkest" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @else
                <li class="mr-4">
                    <a href="{{ route('login') }}" class="text-base no-underline text-grey-darker hover:text-grey-darkest">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="text-base no-underline text-grey-darker hover:text-grey-darkest">Register</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>