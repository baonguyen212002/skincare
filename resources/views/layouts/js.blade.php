<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('owlcarousel2/owl.carousel.js') }}"></script>
{{-- <script src="{{ asset('bootstrap/bootstrap.js') }}"></script> --}}
<script src="{{ asset('bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="{{ asset('js/ajax.js') }}"></script>
<script src="{{ asset('flexslider/jquery.flexslider.min.js') }}"></script>
<script src="https://use.fontawesome.com/b6257cb314.js"></script>
<script>
    $(document).ready(function() {
        var menu_mobi = $('.navbar-nav').html();
        $('.menu_mobi_add').append('<span class="close_menu">X</span><ul>' + menu_mobi + '</ul>');
        $('.menu_mobi_add ul li ul').removeClass('nav-item');
        $('.menu_mobi_add ul li ul').css({
            'display': 'none'
        });
        $('.icon_menu_mobi,.close_menu,.menu_baophu').click(function() {
        if ($('.menu_mobi_add').hasClass('menu_mobi_active')) {
            $('.menu_mobi_add').removeClass('menu_mobi_active');
            $('.menu_baophu').fadeOut(300);
        } else {
            $('.menu_mobi_add').addClass('menu_mobi_active');
            $('.menu_baophu').fadeIn(300);
        }
        return false;
    });
        // $(".owl-carousel").owlCarousel({
        //     loop: true,
        //     margin: 10,
        //     nav: true,
        //     responsive: {
        //         0: {
        //             items: 1,
        //         },
        //         600: {
        //             items: 3,
        //         },
        //         1000: {
        //             items: 5,
        //         },
        //     },
        // });

        $('.owl-thumb-pro').owlCarousel({
            items: 4,
            lazyLoad: false,
            mouseDrag: true,
            touchDrag: true,
            margin: 10,
            smartSpeed: 250,
            nav: false,
            dots: false,
            responsiveClass: true,
            responsiveRefreshRate: 200,
            responsive: {
                0: {
                    items: 3,
                    margin: 10
                },
                500: {
                    items: 4,
                    margin: 10
                }
            }
        });
        $('.prev-thumb-pro').click(function() {
            $('.owl-thumb-pro').trigger('prev.owl.carousel');
        });
        $('.next-thumb-pro').click(function() {
            $('.owl-thumb-pro').trigger('next.owl.carousel');
        });
        window.addEventListener('resize', function() {
            var screenWidth = window.innerWidth;
            var products = document.querySelectorAll('.products_views');

            products.forEach(function(product) {
                if (screenWidth < 1024) {
                    product.classList.add('column-2');
                    product.classList.remove('column-4');
                } else {
                    product.classList.add('column-4');
                    product.classList.remove('column-2');
                }
            });
        });
        window.dispatchEvent(new Event('resize'));
        $(".tabs-title li[data-tab='tab-1']").addClass('current');
        $("#tab-1").addClass('current');

        // Handle tab clicks
        $(".tabs-title li").click(function() {
            var tabId = $(this).attr('data-tab');

            // Remove current class from all tabs and content
            $(".tabs-title li").removeClass('current');
            $(".tab-content").removeClass('current');

            // Add current class to the clicked tab and corresponding content
            $(this).addClass('current');
            $("#" + tabId).addClass('current');
        });
    });
</script>
