<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    @auth
    <button class="sidenav-toggler btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#sidenavSupportedContent" aria-controls="sidenavSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle sidebar') }}" onclick="openNav()">
        <span class="menu-toggler-icon">Menu</span>
    </button>
    @endauth
    <div class="container">
        <a class="navbar-brand w-100 text-center" href="javascript:;">
            {{ config('app.name', 'Company Management') }} | Admin Portal
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @auth
                <li class="nav-item">
                    <a id="navbarDropdown" class="nav-link" href="javascript:;" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
