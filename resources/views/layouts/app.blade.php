

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <title> {{ config('app.name', 'DMW Forms') }} </title> -->
     <title> DMW Forms </title>

    <link rel="icon" href="{{ asset('images/dmwlogo.png') }}" type="image/png">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}" /> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
        .disabled{
            pointer-events: none;
            opacity: 0.6;
        }
        .step-wrapper{
            display:flex;
            justify-content:center;
            margin-bottom:20px;
        }

        .steps{
            display:flex;
            list-style:none;
            padding:0;
            margin:0;
            align-items:center;
        }

        .steps .step{
            position:relative;
            width:36px;
            height:28px;
            background:#e9ecef;
            color:#000;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:6px;
            font-weight:600;
        }

        /* spacing between steps */
        .steps .step + .step{
            margin-left:40px;
        }

        /* connector line */
        .steps .step + .step::before{
            content:"";
            position:absolute;
            left:-40px;
            top:50%;
            transform:translateY(-50%);
            width:40px;
            height:4px;
            background:#e9ecef;
        }

        /* active */
        .steps .step.active{
            background: hsl(225, 80%, 34%);
            color:white;
        }

        /* completed */
        .steps .step.completed{
            background: hsl(225, 71%, 66%);
            color:white;
        }

        /* completed line */
        .steps .step.completed + .step::before{
            background: hsl(225, 71%, 66%);
        }


        /* BACK BUTTON */
        .btn-back{
            background:#4e73df;
            color:white;
            border-radius:8px;
            padding:10px 22px;
            font-weight:600;
            border:none;
        }

        .btn-back:hover{
            background:#3c5ec4;
            color:white;
        }

        /* NEXT BUTTON */
        .btn-next{
            background:#4e73df;
            color:white;
            border-radius:8px;
            padding:10px 22px;
            font-weight:600;
            border:none;
        }

        .btn-next:hover{
            background:#3c5ec4;
            color:white;
        }

        /* MOBILE tweaks */
        @media (max-width: 768px) {

            .step-wrapper{
                margin-bottom:15px;
            }
            .steps .step {
                width: 32px;
                height: 26px;
                font-size: 12px;
            }

            .steps .step + .step {
                margin-left: 25px;
            }

            .steps .step + .step::before {
                left: -25px;
                width: 25px;
            }
        }

        @media (max-width: 425px) {

            .step-wrapper{
                margin-bottom:12px;
            }

            .steps .step {
                width: 28px;
                height: 24px;
                font-size: 11px;
            }

            .steps .step + .step {
                margin-left: 15px;
            }

            .steps .step + .step::before {
                left: -15px;
                width: 15px;
            }
        }

    
    </style>


</head>


<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @if(auth()->check())
        <div class="d-flex min-vh-100">

            <!-- Sidebar -->
            <div class="sidebar d-flex flex-column" style="width: 250px; min-width: 250px; background-color: #1a2a4a;">
                @include('layouts.navigation')
            </div>

            <!-- Main Content -->
            <div class="d-flex flex-column flex-grow-1">
                <div class="content-wrapper flex-grow-1 bg-light">
                    @yield('content')
                </div>
            </div>

        </div>
    @else
    
        <header class="custom-header">
            <div class="logo">
                <img src="{{ asset('images/dmwlogo.png') }}" alt="DMW Logo">
            </div>
            <div class="text">
                <h1>REPUBLIC OF THE PHILIPPINES</h1>
                <h2>Department of Migrant Workers</h2>
                <p class="region-office">Region Office No. III - Gitnang Luzon</p>
                <p class="address">215 MacArthur Hwy, Barangay Dolores, San Fernando, 2000 Pampanga, Philippines</p>
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

    @endif
    <!-- Custom Header -->
    

    


    @if(!auth()->check())
        <footer class="main-footer" style="background: linear-gradient(180deg, #003f8d 0%, #0b3b82 40%, #0e63b8 100%); ">
            <!-- Desktop View -->
            <div class="d-none d-lg-flex align-items-md-center align-items-lg-start px-4 py-3 flex-nowrap" style="border-bottom: 3px solid rgba(255,255,255,0.3);">
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
                                        <h6 class="text-white fw-bold text-uppercase mb-1" style="font-size: 0.75rem;">AURORA PROVINCIAL OFFICE</h6>
                                        <p class="text-white mb-1" style="font-size: 0.65rem;">Old AMH, San Luis St., Brgy. 5, Poblacion, Baler, Aurora</p>
                                        <p class="text-white mb-1" style="font-size: 0.65rem;">Contact Number: 0919-067-4019</p>
                                        <p class="text-white mb-0" style="font-size: 0.65rem;">Email: aurora@dmw.gov.ph</p>
                                    </div>
                            
                                </div>

                                <div class="col-6 col-md-3 col-lg">
                                    <div class="w-100 d-flex flex-column h-100 dmw-info">
                                        <h6 class="text-white fw-bold text-uppercase mb-1" style="font-size: 0.75rem;">NUEVA ECIJA PROVINCIAL OFFICE</h6>
                                        <p class="text-white mb-1" style="font-size: 0.65rem;">Ground Floor Palayan City Business Hub, Barangay Singalat, Palayan City, Nueva Ecija</p>
                                        <p class="text-white mb-1" style="font-size: 0.65rem;">Contact Number: 0961-436-8228</p>
                                        <p class="text-white mb-0" style="font-size: 0.65rem;">Email: nuevaecija@dmw.gov.ph</p>
                                    </div>
                                    
                                </div>

                                <div class="col-6 col-md-3 col-lg ">
                                    <div class="w-100 d-flex flex-column h-100 dmw-info">
                                        <h6 class="text-white fw-bold text-uppercase mb-1" style="font-size: 0.75rem;">BATAAN PROVINCIAL OFFICE</h6>
                                        <p class="text-white mb-1" style="font-size: 0.65rem;">2nd Floor, IBossco Office, The Bunker Bldg., San Jose, Balanga City, Bataan</p>
                                        <p class="text-white mb-1" style="font-size: 0.65rem;">Contact Number: 0969-446-5766</p>
                                        <p class="text-white mb-0" style="font-size: 0.65rem;">Email: bataan@dmw.gov.ph</p>
                                    </div>
                                </div>

                                <div class="col-6 col-md-3 col-lg">
                                    <div class="w-100 d-flex flex-column h-100 dmw-info">
                                        <h6 class="text-white fw-bold text-uppercase mb-1" style="font-size: 0.75rem;">PAMPANGA PROVINCIAL OFFICE</h6>
                                        <p class="text-white mb-1" style="font-size: 0.65rem;">3rd Floor, Government Service Express, SM City Pampanga, Jose Abad Santos Ave., City of San Fernando, Pampanga</p>
                                        <p class="text-white mb-1" style="font-size: 0.65rem;">Contact Number: 0921-512-2450</p>
                                        <p class="text-white mb-0" style="font-size: 0.65rem;">Email: provincialpampanga@dmw.gov.ph</p>
                                    </div>
                                </div>

                                <div class="col-6 col-md-3 col-lg">
                                    <div class="w-100 d-flex flex-column h-100 dmw-info">
                                        <h6 class="text-white fw-bold text-uppercase mb-1" style="font-size: 0.75rem;">BULACAN PROVINCIAL OFFICE</h6>
                                        <p class="text-white mb-0" style="font-size: 0.65rem;">Rooms 301 & 302, PESO Building, Capitol Compound, Barangay Guinhawa, Malolos City, Bulacan</p>
                                        <p class="text-white mb-1" style="font-size: 0.65rem;">Contact Number: 0956-199-0328</p>
                                        <p class="text-white mb-0" style="font-size: 0.65rem;">Email: bulacan@dmw.gov.ph</p>
                                    </div>
                                </div>

                                <div class="col-6 col-md-3 col-lg">
                                    <div class="w-100 d-flex flex-column h-100 dmw-info">
                                        <h6 class="text-white fw-bold text-uppercase mb-1" style="font-size: 0.75rem;">TARLAC PROVINCIAL OFFICE</h6>
                                        <p class="text-white mb-0" style="font-size: 0.65rem;">5th Floor, Tarlac Capitol Center Bldg., Brgy. San Roque, Tarlac City, Tarlac</p>
                                        <p class="text-white mb-1" style="font-size: 0.65rem;">Contact Number: 0968-545-3277</p>
                                        <p class="text-white mb-0" style="font-size: 0.65rem;">Email: tarlac@dmw.gov.ph</p>
                                    </div>
                                </div>

                                <div class="col-6 col-md-3 col-lg">
                                    <div class="w-100 d-flex flex-column h-100 dmw-info">
                                        <h6 class="text-white fw-bold text-uppercase mb-1" style="font-size: 0.75rem;">ZAMBALES PROVINCIAL OFFICE</h6>
                                        <p class="text-white mb-0" style="font-size: 0.65rem;">Lot 374-C-3-C of Barangay Palanginan, Iba, Zambales</p>
                                        <p class="text-white mb-1" style="font-size: 0.65rem;">Contact Number: 0961-419-4088</p>
                                        <p class="text-white mb-0" style="font-size: 0.65rem;">Email: zambales@dmw.gov.ph</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Offices Grid - 7 columns -->
                
            </div>

            <!-- Mobile View - Accordion -->
            <div class="d-block d-lg-none px-3 py-0">
                <div class="d-block d-lg-none text-center mb-3">
                    <div class="pt-4">
                        <img src="{{ asset('images/republika_ng_pilipinas.png') }}" 
                            alt="Republika ng Pilipinas Logo" 
                            class="img-fluid mb-3" 
                            style="max-width: 150px;">
                    </div>
                    <div>
                        <h3 class="text-white fw-bold text-uppercase mb-0" style="font-size: 0.9rem;">
                            Provincial Offices of DMW - RO3
                        </h3>
                    </div>
                </div>
                <div class="accordion accordion-flush" id="footerAccordion">
                    <div class="accordion-item" style="border: 1px solid rgba(255,255,255,0.2); margin-bottom: 0.5rem; border-radius: 0.25rem; background-color: #0b357e;">
                        <h2 class="accordion-header">
                            <button class="accordion-button footer-accordion-button collapsed text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" style="background-color: #0b357e; font-size: 0.8rem;" aria-expanded="false">
                                AURORA PROVINCIAL OFFICE
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                            <div class="accordion-body text-dark bg-white p-2" style="font-size: 0.7rem;">
                                <p class="mb-1">Old AMH, San Luis St., Brgy. 5, Poblacion, Baler, Aurora</p>
                                <p class="mb-1">Contact Number: 0961-385-8812</p>
                                <p class="mb-0">Email: aurora@dmw.gov.ph</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="border: 1px solid rgba(255,255,255,0.2); margin-bottom: 0.5rem; border-radius: 0.25rem; background-color: #0b357e;">
                        <h2 class="accordion-header">
                            <button class="accordion-button footer-accordion-button collapsed text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" style="background-color: #0b357e; font-size: 0.8rem;" aria-expanded="false">
                                NUEVA ECIJA PROVINCIAL OFFICE
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                            <div class="accordion-body text-dark bg-white p-2" style="font-size: 0.7rem;">
                                <p class="mb-1">Ground Floor Palayan City Business Hub, Barangay Singalat, Palayan City, Nueva Ecija</p>
                                <p class="mb-1">Contact Number: 0961-436-8228</p>
                                <p class="mb-0">Email: nuevaecija@dmw.gov.ph</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="border: 1px solid rgba(255,255,255,0.2); margin-bottom: 0.5rem; border-radius: 0.25rem; background-color: #0b357e;">
                        <h2 class="accordion-header">
                            <button class="accordion-button footer-accordion-button collapsed text-white fw-bold footer-accordion-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" style="background-color: #0b357e; font-size: 0.8rem;" aria-expanded="false">
                                BATAAN PROVINCIAL OFFICE
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                            <div class="accordion-body text-dark bg-white p-2" style="font-size: 0.7rem;">
                                <p class="mb-1">2nd Floor, IBossco Office, The Bunker Bldg., San Jose, Balanga City, Bataan</p>
                                <p class="mb-1">Contact Number: 0969-446-5766</p>
                                <p class="mb-0">Email: bataan@dmw.gov.ph</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="border: 1px solid rgba(255,255,255,0.2); margin-bottom: 0.5rem; border-radius: 0.25rem; background-color: #0b357e;">

                        <h2 class="accordion-header">
                            <button class="accordion-button footer-accordion-button footer-accordion-button collapsed text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" style="background-color: #0b357e; font-size: 0.8rem;" aria-expanded="false">
                                PAMPANGA PROVINCIAL OFFICE
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                            <div class="accordion-body text-dark bg-white p-2" style="font-size: 0.7rem;">
                                <p class="mb-1">3rd Floor, Government Service Express, SM City Pampanga, Jose Abad Santos Ave., City of San Fernando, Pampanga</p>
                                <p class="mb-1">Contact Number: 0921-512-2450</p>
                                <p class="mb-0">Email: provincialpampanga@dmw.gov.ph</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="border: 1px solid rgba(255,255,255,0.2); margin-bottom: 0.5rem; border-radius: 0.25rem; background-color: #0b357e;">
                        <h2 class="accordion-header">
                            <button class="accordion-button footer-accordion-button collapsed text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" style="background-color: #0b357e; font-size: 0.8rem;" aria-expanded="false">
                                BULACAN PROVINCIAL OFFICE
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                            <div class="accordion-body text-dark bg-white p-2" style="font-size: 0.7rem;">
                                <p class="mb-0">Rooms 301 & 302, PESO Building, Capitol Compound, Barangay Guinhawa, Malolos City, Bulacan</p>
                                <p class="mb-0">Contact Number: 0956-199-0328</p>
                                <p class="mb-0">Email: bulacan@dmw.gov.ph</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="border: 1px solid rgba(255,255,255,0.2); margin-bottom: 0.5rem; border-radius: 0.25rem; background-color: #0b357e;">
                        <h2 class="accordion-header">
                            <button class="accordion-button footer-accordion-button collapsed text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" style="background-color: #0b357e; font-size: 0.8rem;" aria-expanded="false">
                                TARLAC PROVINCIAL OFFICE
                            </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                            <div class="accordion-body text-dark bg-white p-2" style="font-size: 0.7rem;">
                                <p class="mb-0">5th Floor, Tarlac Capitol Center Bldg., Brgy. San Roque, Tarlac City, Tarlac</p>
                                <p class="mb-0">Contact Number: 0968-545-3277</p>
                                <p class="mb-0">Email: tarlac@dmw.gov.ph</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="border: 1px solid rgba(255,255,255,0.2); margin-bottom: 0.5rem; border-radius: 0.25rem; background-color: #0b357e;">
                        <h2 class="accordion-header">
                            <button class="accordion-button footer-accordion-button collapsed text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" style="background-color: #0b357e; font-size: 0.8rem;" aria-expanded="false">
                                ZAMBALES PROVINCIAL OFFICE
                            </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                            <div class="accordion-body text-dark bg-white p-2" style="font-size: 0.7rem;">
                                <p class="mb-0">Lot 374-C-3-C of Barangay Palanginan, Iba, Zambales</p>
                                <p class="mb-0">Contact Number: 0961-419-4088</p>
                                <p class="mb-0">Email: zambales@dmw.gov.ph</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


         <!-- Footer Bottom -->
            <div class="footer-bottom">
                <h3>DEPARTMENT OF MIGRANT WORKERS REGIONAL NO. 3</h3>
                <p>215 MacArthur Hwy, Barangay Dolores, San Fernando, 2000 Pampanga, Philippines</p>
            </div>
    </footer>
    @endif
</div>

            

       

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
