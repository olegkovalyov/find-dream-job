<header class="bg-green-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="{{ url('/') }}">Find Dream Job</a>
        </h1>
        <nav class="hidden md:flex items-center space-x-4">
            <x-nav-link href="{{url('/jobs')}}" title="All Jobs" currentUrl="jobs" />
            <x-nav-link href="{{url('/jobs/saved')}}" title="Saved Jobs" currentUrl="jobs/saved" />
            <x-nav-link href="{{url('/login')}}" title="Login" currentUrl="login" />
            <x-nav-link href="{{url('/register')}}" title="Register" currentUrl="register" />
            <x-nav-link href="{{url('/dashboard')}}" title="Dashboard" currentUrl="dashboard" icon="fa fa-gauge mr-1" />
            <a
                href="{{ url('/jobs/create') }}"
                class="
                text-white bg-black hover:bg-green-800 px-4 py-2 rounded hover:shadow-md transition duration-300
                {{ request()->is('jobs/create') ? 'bg-green-800 hover:text-white px-4 py-2 rounded hover:shadow-md transition duration-300' :  ''}}
                "
            >
                <i class="fa fa-edit"></i> Create Job
            </a>
        </nav>
        <button
            id="hamburger"
            class="text-white md:hidden flex items-center"
        >
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <nav
        id="mobile-menu"
        class="hidden md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2"
    >
        <a href="{{ url('/jobs') }}" class="block px-4 py-2 hover:bg-blue-700"
        >All Jobs</a
        >
        <a
            href="{{ url('/jobs/saved') }}"
            class="block px-4 py-2 hover:bg-blue-700"
        >Saved Jobs</a
        >
        <a href="{{ url('/login') }}" class="block px-4 py-2 hover:bg-blue-700"
        >Login</a
        >
        <a
            href="{{ url('/jobs/register') }}"
            class="block px-4 py-2 hover:bg-blue-700"
        >Register</a
        >
        <a
            href="{{ url('/dashboard') }}"
            class="block text-white hover:underline py-2"
        >
            <i class="fa fa-gauge mr-1"></i> Dashboard
        </a>
        <a
            href="{{ url('/jobs/create') }}"
            class="block px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-black"
        >
            <i class="fa fa-edit"></i> Create Job
        </a>
    </nav>
</header>
