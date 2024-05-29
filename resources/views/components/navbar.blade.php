<section class="flex items-center justify-between px-5 lg:px-20 pt-3 lg:pt-5">
        <x-app-logo  />
    <div class="buttons">
        @if (Route::has('login'))
            <nav class=" flex flex-1 gap-3 justify-end">
                @auth
                    <a href="{{ url('/dashboard') }}">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-2 bg-black text-white rounded-md">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="hidden lg:flex px-3 py-2 bg-primary-600 text-white rounded-md">


                            Get Started
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </div>
</section>
