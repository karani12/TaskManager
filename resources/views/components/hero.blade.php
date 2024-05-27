<section class="flex flex-col items-center justify-center lg:flex-row lg:pl-20 my-3 ">
    <div class="content-left w-full space-y-3 lg:w-1/3 lg:space-y-4">
        <div class="title px-5 md:px-0">
            <h1 class="text-4xl leading-snug lg:text-5xl font-bold">
                Simplify Your Workflow with TaskManager
            </h1>
        </div>
        <img src="{{ asset('images/hero-mobile.svg') }}" class="full lg:hidden" alt="TaskManager" />

        <div class="content leading-relaxed px-5 md:px-0">
            <p>
                Welcome to TaskManager, your ultimate solution for efficient task management. Designed individuals,
                TaskManager streamlines your projects, deadlines, and daily to-dos with intuitive features and seamless
                integration. Boost your productivity, stay organized, and achieve more with less effort. Try TaskManager
                today and transform the way you work!
            </p>
        </div>
        <div class="btn px-5 lg:px-0 py-3">
            <a href="{{ route('register') }}" class="px-6 py-3 bg-primary-600 text-white rounded-md">
                Get Started
            </a>
        </div>
    </div>
    <div class="image-right hidden lg:block lg:w-2/3">
        <img src="{{ asset('images/hero.svg') }}" class="full" alt="TaskManager" />
    </div>
</section>
