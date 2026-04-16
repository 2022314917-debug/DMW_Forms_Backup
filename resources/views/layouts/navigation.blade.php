@vite(['resources/css/navigation.css', 'resources/js/navigation.js'])

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