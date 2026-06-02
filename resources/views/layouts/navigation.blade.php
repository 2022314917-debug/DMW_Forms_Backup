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
                    <a href="#requestCollapse"
                    class="nav-link collapse-toggle d-flex align-items-center gap-2"
                    data-bs-toggle="collapse"
                    aria-expanded="false"
                    aria-controls="requestCollapse">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="#fff">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zm-1 1.5L18.5 9H13zM6 20V4h5v6h6v10zm2-8h8v1.5H8zm0 3h8v1.5H8zm0 3h5v1.5H8z"/>
                        </svg>
                        <span>{{ __('Request') }}</span>
                        <svg class="chevron ms-auto" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="#fff" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </a>
                    <div class="collapse sub-nav" id="requestCollapse">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('forms-submitted.index', ['status' => 'NEW_SUBMISSION']) }}" class="nav-link">
                                    <span>New Submissions</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('forms-submitted.index', ['status' => 'FORMS_REQUESTED']) }}" class="nav-link">
                                    <span>Forms in Progress</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('forms-submitted.index', ['status' => 'SUBMITTED_FOR_REVIEW']) }}" class="nav-link">
                                    <span>Submitted For Review</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('forms-submitted.index', ['status' => 'APPROVED']) }}" class="nav-link">
                                    <span>Approved</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('forms-submitted.index', ['status' => 'declined']) }}" class="nav-link">
                                    <span>Declined</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#fff" viewBox="0 0 256 256">
                            <path d="M176 60H80a4 4 0 0 0-4 4v48a4 4 0 0 0 4 4h96a4 4 0 0 0 4-4V64a4 4 0 0 0-4-4m-4 48H84V68h88Zm28-80H56a12 12 0 0 0-12 12v176a12 12 0 0 0 12 12h144a12 12 0 0 0 12-12V40a12 12 0 0 0-12-12m4 188a4 4 0 0 1-4 4H56a4 4 0 0 1-4-4V40a4 4 0 0 1 4-4h144a4 4 0 0 1 4 4ZM96 148a8 8 0 1 1-8-8 8 8 0 0 1 8 8m40 0a8 8 0 1 1-8-8 8 8 0 0 1 8 8m40 0a8 8 0 1 1-8-8 8 8 0 0 1 8 8m-80 40a8 8 0 1 1-8-8 8 8 0 0 1 8 8m40 0a8 8 0 1 1-8-8 8 8 0 0 1 8 8m40 0a8 8 0 1 1-8-8 8 8 0 0 1 8 8"/>
                        </svg>
                        <span>{{ __('Forms') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('employees.index') }}" class="nav-link d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="4"></circle>
                            <path d="M4 20c0-4 4-6 8-6s8 2 8 6"></path>
                        </svg>
                        <span>{{ __('Employees') }}</span>
                    </a>
                </li>

            </ul>
        </nav>

        <!-- Bottom nav items -->

        <div class="px-3 py-3" style="border-top: 1px solid rgba(255,255,255,0.15);">
            <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link d-flex align-items-center gap-2 w-100 border-0 bg-transparent" style="cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#fff" viewBox="0 0 24 24">
                        <path d="M16 13v-2H7V8l-5 4 5 4v-3zM20 3H10a2 2 0 0 0-2 2v4h2V5h10v14H10v-4H8v4a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2z"/>
                    </svg>
                    <span>{{ __('Logout') }}</span>
                </button>
            </form>
        </div>
        
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