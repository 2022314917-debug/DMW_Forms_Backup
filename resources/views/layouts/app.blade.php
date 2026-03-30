

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
    <!-- <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Vite -->
    
    {{-- @vite(['resources/css/header.css']) --}}


    <!-- Custom Footer CSS -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    <style>
        @media (min-width: 768px) and (max-width: 991.98px) {

            .footer-logo-res img {
                max-width: 150px !important;
            }

            
            .dmw-info h6 {
                font-size: 0.65rem !important;
            }
            .dmw-info p {
                font-size: 0.55rem !important;
            }

            .footer-accordion-icon{
                color: #fff;
            }
        }
    </style>

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



    <footer class="main-footer" style="background: linear-gradient(180deg, #003f8d 0%, #0b3b82 40%, #0e63b8 100%);">
        <!-- Desktop View -->
        <div class="d-none d-md-flex align-items-md-center align-items-lg-start px-4 py-3 flex-nowrap" style="border-bottom: 3px solid rgba(255,255,255,0.3);">
            <!-- Header Row with Logo and Title -->
            <div class="d-flex align-items-md-center me-3">
                <div class="col-auto d-none d-sm-flex footer-logo-res">
                    <img src="{{ asset('images/republika_ng_pilipinas.png') }}" alt="Republika ng Pilipinas Logo" class="img-fluid" style="max-width: 150px;">
                </div>
            </div>

            <div class="flex-grow-1">
                <div class="row align-items-center">



                    <div class="col-12 mb-2 d-none d-sm-block">
                        <h3 class="text-white fw-bold text-uppercase mb-0" style="font-size: 1rem;">
                            Provincial Offices of DMW - RO3
                        </h3>
                    </div>

                    <div class="col-12 py-2">
                        <div class="row g-3">

                            
                            <div class="col-6 col-md-3 col-lg">
                                <div class="w-100 d-flex flex-column h-100 dmw-info">
                                    <h6 class="text-white fw-bold text-uppercase mb-1" style="font-size: 0.75rem;">DMW RO3 Annex</h6>
                                    <p class="text-white mb-1" style="font-size: 0.65rem;">Government Express Service, 3rd Floor, Main Building, SM City Pampanga</p>
                                    <p class="text-white mb-1" style="font-size: 0.65rem;">Contact Number: 0919-067-4019</p>
                                    <p class="text-white mb-0" style="font-size: 0.65rem;">Email: processing.ro3@dmw.gov.ph</p>
                                </div>
                        
                            </div>

                            <div class="col-6 col-md-3 col-lg">
                                <div class="w-100 d-flex flex-column h-100 dmw-info">
                                    <h6 class="text-white fw-bold text-uppercase mb-1" style="font-size: 0.75rem;">OSSCO CLARK</h6>
                                    <p class="text-white mb-1" style="font-size: 0.65rem;">One Stop Shop Government Center (Clark Polytechnic), Jose Abad Santos Ave.</p>
                                    <p class="text-white mb-1" style="font-size: 0.65rem;">Contact Number: 0919-067-4043</p>
                                    <p class="text-white mb-0" style="font-size: 0.65rem;">Email: processing.ro3@dmw.gov.ph</p>
                                </div>
                                
                            </div>

                            <div class="col-6 col-md-3 col-lg ">
                                <div class="w-100 d-flex flex-column h-100 dmw-info">
                                    <h6 class="text-white fw-bold text-uppercase mb-1" style="font-size: 0.75rem;">Bataan Office</h6>
                                    <p class="text-white mb-1" style="font-size: 0.65rem;">2nd Floor 1BOSSCO The Bunker Bldg. San Jose Balanga City</p>
                                    <p class="text-white mb-1" style="font-size: 0.65rem;">Contact Number: 0991-650-0855</p>
                                    <p class="text-white mb-0" style="font-size: 0.65rem;">Email: bataan@dmw.gov.ph</p>
                                </div>
                            </div>

                            <div class="col-6 col-md-3 col-lg">
                                <div class="w-100 d-flex flex-column h-100 dmw-info">
                                    <h6 class="text-white fw-bold text-uppercase mb-1" style="font-size: 0.75rem;">Nueva Ecija Office</h6>
                                    <p class="text-white mb-1" style="font-size: 0.65rem;">G/F Business Hub OSSCO Brgy. Singalat, Palayan City</p>
                                    <p class="text-white mb-1" style="font-size: 0.65rem;">Contact Number: 0967-634-1092</p>
                                    <p class="text-white mb-0" style="font-size: 0.65rem;">Email: ossco_palayan@dmw.gov.ph</p>
                                </div>
                            </div>

                            <div class="col-6 col-md-3 col-lg">
                                <div class="w-100 d-flex flex-column h-100 dmw-info">
                                    <h6 class="text-white fw-bold text-uppercase mb-1" style="font-size: 0.75rem;">Bulacan Office</h6>
                                    <p class="text-white mb-0" style="font-size: 0.65rem;">Rooms 301 & 302 PESO Bldg., Bulacan Capitol Compound</p>
                                </div>
                            </div>

                            <div class="col-6 col-md-3 col-lg">
                                <div class="w-100 d-flex flex-column h-100 dmw-info">
                                    <h6 class="text-white fw-bold text-uppercase mb-1" style="font-size: 0.75rem;">Tarlac Office</h6>
                                    <p class="text-white mb-0" style="font-size: 0.65rem;">Ground Floor Right Wing IT Training Center Bldg.</p>
                                </div>
                            </div>

                            <div class="col-6 col-md-3 col-lg">
                                <div class="w-100 d-flex flex-column h-100 dmw-info">
                                    <h6 class="text-white fw-bold text-uppercase mb-1" style="font-size: 0.75rem;">Zambales Office</h6>
                                    <p class="text-white mb-0" style="font-size: 0.65rem;">Lot 374-C-3-C, Brgy. Palanginan, Iba</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Offices Grid - 7 columns -->
            
        </div>

        <!-- Mobile/Tablet View - Accordion -->
        <div class="d-block d-md-none px-3 py-0">
            <div class="d-block d-sm-none text-center mb-3">
                <div>
                    <img src="{{ asset('images/republika_ng_pilipinas.png') }}" 
                        alt="Republika ng Pilipinas Logo" 
                        class="img-fluid mb-3" 
                        style="max-width: 150px;">
                </div>
                <div>
                    <h3 class="text-white fw-bold text-uppercase mb-0" style="font-size: 0.9rem;">
                        Provincial Offices of DMW - RO3 (bottom)
                    </h3>
                </div>
            </div>
            <div class="accordion accordion-flush" id="footerAccordion">
                <div class="accordion-item" style="border: 1px solid rgba(255,255,255,0.2); margin-bottom: 0.5rem; border-radius: 0.25rem; background-color: #0b357e;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" style="background-color: #0b357e; font-size: 0.8rem;" aria-expanded="false">
                            DMW RO3 Annex​
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                        <div class="accordion-body text-dark bg-white p-2" style="font-size: 0.7rem;">
                            <p class="mb-1">Government Express Service, 3rd Floor, Main Building, SM City Pampanga</p>
                            <p class="mb-1">Contact Number: 0919-067-4019</p>
                            <p class="mb-0">Email: processing.ro3@dmw.gov.ph</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" style="border: 1px solid rgba(255,255,255,0.2); margin-bottom: 0.5rem; border-radius: 0.25rem; background-color: #0b357e;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" style="background-color: #0b357e; font-size: 0.8rem;" aria-expanded="false">
                            OSSCO CLARK​
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                        <div class="accordion-body text-dark bg-white p-2" style="font-size: 0.7rem;">
                            <p class="mb-1">One Stop Shop Government Center (Clark Polytechnic), Jose Abad Santos Ave. Clark Freeport Zone</p>
                            <p class="mb-1">Contact Number: 0919-067-4043</p>
                            <p class="mb-0">Email: processing.ro3@dmw.gov.ph</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" style="border: 1px solid rgba(255,255,255,0.2); margin-bottom: 0.5rem; border-radius: 0.25rem; background-color: #0b357e;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed text-white fw-bold footer-accordion-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" style="background-color: #0b357e; font-size: 0.8rem;" aria-expanded="false">
                            Bataan Office​
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                        <div class="accordion-body text-dark bg-white p-2" style="font-size: 0.7rem;">
                            <p class="mb-1">2nd Floor 1BOSSCO The Bunker Bldg. San Jose Balanga City, Bataan</p>
                            <p class="mb-1">Contact Number: 0991-650-0855</p>
                            <p class="mb-0">Email: bataan@dmw.gov.ph</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" style="border: 1px solid rgba(255,255,255,0.2); margin-bottom: 0.5rem; border-radius: 0.25rem; background-color: #0b357e;">

                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" style="background-color: #0b357e; font-size: 0.8rem;" aria-expanded="false">
                            Nueva Ecija Office​
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                        <div class="accordion-body text-dark bg-white p-2" style="font-size: 0.7rem;">
                            <p class="mb-1">G/F Business Hub OSSCO Brgy. Singalat, Palayan City, Nueva Ecija</p>
                            <p class="mb-1">Contact Number: 0967-634-1092</p>
                            <p class="mb-0">Email: ossco_palayan@dmw.gov.ph</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" style="border: 1px solid rgba(255,255,255,0.2); margin-bottom: 0.5rem; border-radius: 0.25rem; background-color: #0b357e;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" style="background-color: #0b357e; font-size: 0.8rem;" aria-expanded="false">
                            Bulacan Office​
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                        <div class="accordion-body text-dark bg-white p-2" style="font-size: 0.7rem;">
                            <p class="mb-0">Rooms 301 & 302 PESO Bldg., Bulacan Capitol Compound, Malolos City, Bulacan</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" style="border: 1px solid rgba(255,255,255,0.2); margin-bottom: 0.5rem; border-radius: 0.25rem; background-color: #0b357e;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" style="background-color: #0b357e; font-size: 0.8rem;" aria-expanded="false">
                            Tarlac Office​
                        </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                        <div class="accordion-body text-dark bg-white p-2" style="font-size: 0.7rem;">
                            <p class="mb-0">Ground Floor Right Wing IT Training Center Bldg. IT Park 1, Tibag, Tarlac City</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" style="border: 1px solid rgba(255,255,255,0.2); margin-bottom: 0.5rem; border-radius: 0.25rem; background-color: #0b357e;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" style="background-color: #0b357e; font-size: 0.8rem;" aria-expanded="false">
                            Zambales Office​
                        </button>
                    </h2>
                    <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                        <div class="accordion-body text-dark bg-white p-2" style="font-size: 0.7rem;">
                            <p class="mb-0">Lot 374-C-3-C, Brgy. Palanginan, Iba, Zambales</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </footer>
</div>

            

        <!-- Footer Bottom -->
            <div class="footer-bottom">
                <h3>Department of Migrant Workers (DMW) Regional No. 3</h3>
                <p>215 MacArthur Hwy, Barangay Dolores, San Fernando, 2000 Pampanga, Philippines</p>
            </div>
    </footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery FIRST -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle (includes Popper) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script> -->

<!-- AdminLTE -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>

<!-- Toastr -->

<!-- Custom Footer JavaScript -->
<script src="{{ asset('js/footer.js') }}"></script>


</body>

</html>
