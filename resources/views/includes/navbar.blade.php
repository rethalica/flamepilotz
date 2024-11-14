<nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
    <h1 class="text-primary d-flex align-items-center fw-bold" style="font-size: 2.25rem;">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Flame Pilot Logo" class="me-3"
            style="width: 50px; height: auto;">
        FlamePilot
    </h1>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="index.html" class="nav-item nav-link active fw-bold">Home</a>
            <a href="{{ route('monitoring') }}" class="nav-item nav-link fw-bold">Monitoring</a>
            @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link mx-1 fw-bold" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link mx-1 fw-bold" href="{{ route('login') }}">Login</a>
                </li>
            @endif
        </div>
    </div>
</nav>
