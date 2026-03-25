

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Google Font: Source Sans Pro, Cinzel, Grenze Gotisch, Inter, and Average -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700|Cinzel|Grenze+Gotisch|Inter|Average&display=swap">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Vite -->
    
    {{-- @vite(['resources/css/header.css']) --}}
    {{-- @vite(['resources/css/footer.css', 'resources/js/footer.js']) --}}

    <!-- Custom Footer CSS -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

</head>


<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Custom Header -->
    <header class="custom-header">
        <div class="logo">
            <img src="{{ asset('images/dmwlogo.png') }}" alt="DMW Logo">
        </div>
        <div class="text">
            <h1>REPUBLIC OF THE PHILIPPINES</h1>
            <h2>Department of Migrant Workers</h2>
            <p class="region-office">Region Office No. III - Gitnang Luzon</p>
            <p class="address">DMW-RO3-MAIN OFFICE, JOSE ABAD SANTOS AVENUE, LAGUNDI, MEXICO, PAMPANGA</p>
        </div>
        <div class="bagong-pilipinas">
            <img src="{{ asset('images/Bagong_Pilipinas.png') }}" alt="Bagong Pilipinas Logo">
        </div>

    </header>

    <!-- Top Navigation -->
    @include('layouts.navigation')

    <!-- Content Wrapper -->

    <!-- Content Wrapper -->
    <div class="d-flex flex-column min-vh-100">
        <div class="content-wrapper flex-grow-1 bg-light">
            @yield('content')
        </div>
    </div>



    <footer class="main-footer">
        <div class="footer-container">
            <!-- Desktop View: Grid Layout -->
            <div class="footer-grid">
                <!-- Division 1: About Us -->
                <div class="footer-section">
                    <h6>DMW RO3 Annex​</h6>
                    <p>Government Express Service, 3rd Floor, Main Building, SM City Pampanga</p>
                    <p>Contact Number: 0919-067-4019</p>
                    <p>Email: processing.ro3@dmw.gov.ph​</p>
                </div>

                <!-- Division 2: Quick Links -->
                <div class="footer-section">
                    <h6>OSSCO CLARK</h6>
                    <p>One Stop Shop Government Center (Clark Polytechnic), Jose Abad Santos Ave. Clark Freepointgt Zone</p>
                    <p>Contact Number: 0919-067-4043</p>
                    <p>Email: processing.ro3@dmw.gov.ph​</p>
                </div>

                <!-- Division 3: Assistance -->
                <div class="footer-section">
                    <h6>Bataan Office​</h6>
                    <p>2nd Floor 1BOSSCO The Bunker Bldg. San Jose Balanga City, Bataan</p>
                    <p>Contact Number: 0991-650-0855</p>
                    <p>Email: bataan@dmw.gov.ph</p>
                </div>

                <!-- Division 4: Resources -->
                <div class="footer-section">
                    <h6>Bulacan Office​</h6>
                    <p>Rooms 301 & 302 PESO Bldg., Bulacan Capitol Compound, Malolos City, Bulacan​</p>
                </div>

                <!-- Division 5: Legal -->
                <div class="footer-section">
                    <h6>Nueva Ecija Office​</h6>
                    <p>G/F Business Hub OSSCO Brgy. Singalat, Palayan City, Nueva Ecija</p>
                    <p>Contact Number: 0967-634-1092</p>
                    <p>Email: ossco_palayan@dmw.gov.ph​</p>
                </div>

                <!-- Division 6: Contact -->
                <div class="footer-section">
                    <h6>Tarlac Office​</h6>
                    <p>Ground Floor Right Wing IT Training Center Bldg. IT Park 1, Tibag, Tarlac City​</p>
                </div>

                <!-- Division 7: Social Media -->
                <div class="footer-section">
                    <h6>Zambales Office​</h6>
                    <p>Lot 374-C-3-C, Brgy. Palanginan, Iba, Zambales​</p>
                </div>
            </div>

            <!-- Mobile & Tablet View: Custom Accordion -->
            <div class="footer-accordion">
                <!-- Accordion Item 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" onclick="toggleAccordion(this)">
                            <span>DMW RO3 Annex​</span>
                            <i class="fas fa-chevron-up accordion-icon"></i>
                        </button>
                    </h2>
                    <div class="accordion-body">
                        <p>Government Express Service, 3rd Floor, Main Building, SM City Pampanga</p>
                        <p>Contact Number: 0919-067-4019</p>
                        <p>Email: processing.ro3@dmw.gov.ph​</p>
                    </div>
                </div>

                <!-- Accordion Item 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" onclick="toggleAccordion(this)">
                            <span>OSSCO CLARK​</span>
                            <i class="fas fa-chevron-up accordion-icon"></i>
                        </button>
                    </h2>
                    <div class="accordion-body">
                        <p>One Stop Shop Government Center (Clark Polytechnic), Jose Abad Santos Ave. Clark Freepointgt Zone</p>
                        <p>Contact Number: 0919-067-4043</p>
                        <p>Email: processing.ro3@dmw.gov.ph​​</p>
                    </div>
                </div>

                <!-- Accordion Item 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" onclick="toggleAccordion(this)">
                            <span>Bataan Office​</span>
                            <i class="fas fa-chevron-up accordion-icon"></i>
                        </button>
                    </h2>
                    <div class="accordion-body">
                        <p>2nd Floor 1BOSSCO The Bunker Bldg. San Jose Balanga City, Bataan</p>
                        <p>Contact Number: 0991-650-0855</p>
                        <p>Email: bataan@dmw.gov.ph​​</p>
                    </div>
                </div>

                <!-- Accordion Item 4 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" onclick="toggleAccordion(this)">
                            <span>Bulacan Office​</span>
                            <i class="fas fa-chevron-up accordion-icon"></i>
                        </button>
                    </h2>
                    <div class="accordion-body">
                        <p>Rooms 301 & 302 PESO Bldg., Bulacan Capitol Compound, Malolos City, Bulacan​</p>
                    </div>
                </div>

                <!-- Accordion Item 5 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" onclick="toggleAccordion(this)">
                            <span>Nueva Ecija Office​</span>
                            <i class="fas fa-chevron-up accordion-icon"></i>
                        </button>
                    </h2>
                    <div class="accordion-body">
                        <p>G/F Business Hub OSSCO Brgy. Singalat, Palayan City, Nueva Ecija</p>
                        <p>Contact Number: 0967-634-1092</p>
                        <p>Email: ossco_palayan@dmw.gov.ph​​​</p>
                    </div>
                </div>

                <!-- Accordion Item 6 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" onclick="toggleAccordion(this)">
                            <span>Tarlac Office​</span>
                            <i class="fas fa-chevron-up accordion-icon"></i>
                        </button>
                    </h2>
                    <div class="accordion-body">
                        <p>Ground Floor Right Wing IT Training Center Bldg. IT Park 1, Tibag, Tarlac City​</p>
                    </div>
                </div>

                <!-- Accordion Item 7 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" onclick="toggleAccordion(this)">
                            <span>Zambales Office​</span>
                            <i class="fas fa-chevron-up accordion-icon"></i>
                        </button>
                    </h2>
                    <div class="accordion-body">
                        <p>Lot 374-C-3-C, Brgy. Palanginan, Iba, Zambales​</p>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p>&copy; 2026 Department of Migrant Workers. All rights reserved.</p>
            </div>
        </div>
    </footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery FIRST -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<!-- AdminLTE -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>

<!-- Toastr -->

<!-- Custom Footer JavaScript -->
<script src="{{ asset('js/footer.js') }}"></script>


</body>

</html>
