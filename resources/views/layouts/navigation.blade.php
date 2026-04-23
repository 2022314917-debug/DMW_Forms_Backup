@vite(['resources/css/navigation.css', 'resources/js/navigation.js'])


@if(auth()->check())

    <div class="sidebar d-flex flex-column flex-grow-1">
    
        <div class="d-flex align-items-center gap-2 px-3 py-3" style="border-bottom: 1px solid rgba(255,255,255,0.15);">
            <img src="{{ asset('images/dmwlogo.png') }}" 
                alt="DMW Logo" 
                style="width: 40px; height: 40px; object-fit: contain; flex-shrink: 0;">
            <div class="d-flex flex-column" style="overflow: hidden;">
                <span style="color: #fff; font-size: 0.8rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {{ auth()->user()->emp_fname }} {{ auth()->user()->emp_lname }}
                </span>
                <span style="color: rgba(255,255,255,0.5); font-size: 0.7rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {{ auth()->user()->email }}
                </span>
            </div>
        </div>
        <!-- Top nav items -->
        <nav class="mt-2 flex-grow-1">
            <ul class="nav flex-column">

                <li class="nav-item">
                    <a href="" class="nav-link d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#fff" viewBox="0 0 24 24">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#inventoryCollapse"
                    class="nav-link collapse-toggle d-flex align-items-center gap-2"
                    data-bs-toggle="collapse"
                    aria-expanded="false"
                    aria-controls="inventoryCollapse">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512" fill="#fff">
                            <path d="m35.68 54.7-4.89 17.17 92.71 27.3 5.3 1.53L179 367.4c3.4-1.2 6.9-2.2 10.6-2.9 1.7-.3 3.3-.5 5-.7L142.1 85.03zm274.62 59.2-139.5 26.3 20.4 107.9L330.7 222zm86.6 113.9-45.2 8.5v.1l-128.5 24.1-28.7 5.4 18.4 98c21.3 3 40.3 15.3 51.8 33.3l158.5-29.8zM458 379.1 272.6 414c.9 2.9 1.6 5.8 2.2 8.8.4 2.3.8 4.6 1 6.9l185.1-34.8zm-254 2.1c-3.6 0-7.3.3-11.1 1-29.9 5.6-49.5 34.3-43.8 64.2 5.6 30 34.2 49.5 64.2 43.9s49.5-34.2 43.9-64.2c-5-26.3-27.5-44.5-53.2-44.9m-1.6 21.3c15.3.3 29 11.3 32 26.9 3.3 17.7-8.6 35.1-26.4 38.5-17.8 3.3-35.1-8.5-38.5-26.3-3.3-17.8 8.5-35.2 26.3-38.6 2.2-.4 4.4-.6 6.6-.5m-.2 17.9q-1.5 0-3 .3c-8.3 1.6-13.6 9.3-12 17.5 1.5 8.3 9.3 13.6 17.5 12 8.3-1.6 13.5-9.3 12-17.5-1.4-7.3-7.5-12.2-14.5-12.3"/>
                        </svg>
                        <span>{{ __('Inventory') }}</span>
                        <svg class="chevron ms-auto" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="#fff" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </a>
                    <div class="collapse sub-nav" id="inventoryCollapse">
                        <ul class="nav flex-column">
                            <li class="nav-item"><a href="" class="nav-link"><span>Management</span></a></li>
                            <li class="nav-item"><a href="" class="nav-link"><span>Adjustment</span></a></li>
                            <li class="nav-item"><a href="" class="nav-link"><span>Logs</span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#fff" viewBox="0 0 256 256">
                            <path d="M176 60H80a4 4 0 0 0-4 4v48a4 4 0 0 0 4 4h96a4 4 0 0 0 4-4V64a4 4 0 0 0-4-4m-4 48H84V68h88Zm28-80H56a12 12 0 0 0-12 12v176a12 12 0 0 0 12 12h144a12 12 0 0 0 12-12V40a12 12 0 0 0-12-12m4 188a4 4 0 0 1-4 4H56a4 4 0 0 1-4-4V40a4 4 0 0 1 4-4h144a4 4 0 0 1 4 4ZM96 148a8 8 0 1 1-8-8 8 8 0 0 1 8 8m40 0a8 8 0 1 1-8-8 8 8 0 0 1 8 8m40 0a8 8 0 1 1-8-8 8 8 0 0 1 8 8m-80 40a8 8 0 1 1-8-8 8 8 0 0 1 8 8m40 0a8 8 0 1 1-8-8 8 8 0 0 1 8 8m40 0a8 8 0 1 1-8-8 8 8 0 0 1 8 8"/>
                        </svg>
                        <span>{{ __('Point of Sale') }}</span>
                    </a>
                </li>

            </ul>
        </nav>

        <!-- Bottom nav items -->
        
    </div>

@else
    <nav class="main-header navbar navbar-expand-md navbar-dark bg-navbar sticky-top">
        <!-- Mobile/Tablet burger menu button -->
        <button class="navbar-toggler d-md-none" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar links -->
        <div class="navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item mx-3">
                    <a href="{{ route('home') }}" class="nav-link text-white">Home</a>
                </li>

                <li class="nav-item mx-3">
                    <a href="{{ route('about') }}" class="nav-link text-white">About</a>
                    
                </li>

                <li class="nav-item mx-3">
                    <a href="{{ route('forms.index') }}" class="nav-link text-white">Forms</a>
                </li>

                @auth
                <!-- Desktop: logout icon with dropdown -->
                <li class="nav-item ms-auto d-none d-md-flex align-items-center position-relative">
                    <button id="logoutIconBtn" class="btn btn-link nav-link text-white px-4" type="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                    <div id="logoutDropdown" class="logout-dropdown bg-white text-dark rounded shadow">
                        <a href="#" class="dropdown-item text-dark" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </div>
                </li>

                <!-- Mobile/Tablet: plain logout item under Forms -->
                <li id="mobile-logout-item" class="nav-item d-md-none">
                    <a href="#" class="nav-link text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endauth

            </ul>

        </div>
    </nav>

@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoutBtn = document.getElementById('logoutIconBtn');
        const logoutDropdown = document.getElementById('logoutDropdown');

        if (logoutBtn && logoutDropdown) {
            logoutBtn.addEventListener('click', function (event) {
                event.stopPropagation();
                logoutDropdown.classList.toggle('show');
            });

            logoutDropdown.addEventListener('click', function (event) {
                event.stopPropagation();
            });

            document.addEventListener('click', function () {
                logoutDropdown.classList.remove('show');
            });
        }
    });
</script>