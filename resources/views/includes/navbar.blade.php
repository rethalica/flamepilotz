<nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
    <h1 class="navbar-brand d-flex align-items-center fw-bold text-gradient flex-auto">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Flame Pilot Logo" class="logo-image me-3">
        FlamePilot
    </h1>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0" x-data="{ currentPath: window.location.pathname }">
            <a href="{{ route('home') }}" class="nav-item nav-link fw-bold text-decoration-none"
                :class="{ 'text-primary': currentPath === '/' }" @mouseenter="$el.classList.add('text-primary')"
                @mouseleave="$el.classList.remove('text-primary', currentPath !== '/')">
                Home
            </a>
            <a href="{{ route('monitoring') }}" class="nav-item nav-link fw-bold text-decoration-none"
                :class="{ 'text-primary': currentPath === '/monitoring' }"
                @mouseenter="$el.classList.add('text-primary')"
                @mouseleave="$el.classList.remove('text-primary', currentPath !== '/monitoring')">
                Monitoring
            </a>
            <a href="{{ route('faq') }}" class="nav-item nav-link fw-bold text-decoration-none"
                :class="{ 'text-primary': currentPath === '/faq' }" @mouseenter="$el.classList.add('text-primary')"
                @mouseleave="$el.classList.remove('text-primary', currentPath !== '/faq')">
                FAQ
            </a>
            @if (Auth::check())
                <!-- Dropdown Menu untuk Profile dan Logout -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bold text-decoration-none" href="#" id="userDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false"
                        @mouseenter="$el.classList.add('text-primary')"
                        @mouseleave="$el.classList.remove('text-primary')">
                        Logout
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link mx-1 fw-bold text-decoration-none" href="{{ route('login') }}"
                        :class="{ 'text-primary': currentPath === '/login' }"
                        @mouseenter="$el.classList.add('text-primary')"
                        @mouseleave="$el.classList.remove('text-primary', currentPath !== '/login')">
                        Login
                    </a>
                </li>
            @endif
        </div>
    </div>
</nav>
