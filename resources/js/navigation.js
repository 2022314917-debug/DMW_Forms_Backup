$(document).ready(function() {
    var $collapse = $('#navbarNav');
    var $header = $('.custom-header');
    var $navbar = $('.navbar');

    function updateCollapsePosition() {
        if (window.matchMedia('(max-width: 767.98px)').matches) {
            var headerHeight = $header.outerHeight() || 0;
            var navbarHeight = $navbar.outerHeight() || 0;
            var totalTop = headerHeight + navbarHeight;
            $collapse.css('height', '100vh');
        } else {
            $collapse.css('height', '');
        }
    }

    updateCollapsePosition();
    $(window).on('resize', updateCollapsePosition);

    // Custom toggle function
    $('.navbar-toggler').on('click', function(e) {
        e.preventDefault();
        var $collapse = $('#navbarNav');
        var $icon = $(this).find('i');
        $collapse.toggleClass('show');
        if ($collapse.hasClass('show')) {
            $icon.removeClass('fa-bars').addClass('fa-times');
        } else {
            $icon.removeClass('fa-times').addClass('fa-bars');
        }
    });

    // Close menu when clicking outside the navigation or on the overlay
    $(document).on('click', function(e) {
        var $collapse = $('#navbarNav');
        if ($collapse.hasClass('show') && (!$(e.target).closest('#navbarNav, .navbar-toggler').length || e.clientX > window.innerWidth * 0.8)) {
            $collapse.removeClass('show');
            $('.navbar-toggler i').removeClass('fa-times').addClass('fa-bars');
        }
    });

    // Prevent menu from closing when clicking inside the navigation
    $('.navbar-nav').on('click', function(e) {
        e.stopPropagation();
    });
});