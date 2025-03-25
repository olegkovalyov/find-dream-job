<header class="bg-green-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="{{ url('/') }}">Find Dream Job</a>
        </h1>
        <nav class="hidden md:flex items-center space-x-4">
            @if(auth()->user())
                <x-nav-link href="{{url('/jobs')}}" title="All Jobs" currentUrl="jobs"/>
                <x-nav-link href="{{url('/jobs/saved')}}" title="Saved Jobs" currentUrl="jobs/saved"/>
                <x-nav-link href="{{url('/dashboard')}}" title="Dashboard" currentUrl="dashboard" icon="fa fa-gauge mr-1"/>
                <x-nav-link href="{{url('/logout')}}" title="Logout" currentUrl="logout"/>
                <x-button-link url='/jobs/create' icon='edit' isActive="true">Create Job</x-button-link>
            @else
                <x-nav-link href="{{url('/login')}}" title="Login" currentUrl="login"/>
                <x-nav-link href="{{url('/register')}}" title="Register" currentUrl="register"/>
            @endif
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
        class="hidden md:hidden bg-green-600 text-white mt-5 pb-4 space-y-2"
    >
        <x-nav-link href="{{url('/')}}" title="Home" currentUrl="/" isMobile="true"/>
        @if(auth()->user())
            <x-nav-link href="{{url('/jobs')}}" title="All Jobs" currentUrl="jobs" isMobile="true"/>
            <x-nav-link href="{{url('/jobs/saved')}}" title="Saved Jobs" currentUrl="jobs/saved" isMobile="true"/>
            <x-nav-link href="{{url('/dashboard')}}" title="Dashboard" currentUrl="dashboard" icon="fa fa-gauge mr-1" isMobile="true"/>
            <x-nav-link href="{{url('/logout')}}" title="Logout" currentUrl="logout" isMobile="true"/>
            <x-nav-link href="{{url('/jobs/create')}}" title="Create Job" currentUrl="jobs/create" icon="fa fa-edit mr-1" isMobile="true"/>
        @else
            <x-nav-link href="{{url('/login')}}" title="Login" currentUrl="login" isMobile="true"/>
            <x-nav-link href="{{url('/register')}}" title="Register" currentUrl="register" isMobile="true"/>
        @endif
    </nav>
</header>
