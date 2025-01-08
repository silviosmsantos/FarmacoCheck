<nav class="-mx-3 flex  gap-2 justify-end">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            Dashboard
        </a>

    @else
        <a
            href="{{ route('login') }}"
            class="rounded-md px-3  text-black/80 ring-1 ring-transparent transition hover:text-black/60 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >


        <x-icon name="user-circle" class="w-10 h-10" />
    </a>

        @if (Route::has('register'))
            <x-button secondary size="48px">

                <a
                    href="{{ route('register') }}"
                    class="rounded-md px-3   ring-1 ring-transparent transition  focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Registre-se
                </a>
            </x-button>
        @endif
    @endauth
</nav>
