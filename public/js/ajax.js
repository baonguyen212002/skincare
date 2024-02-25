// ready
$(document).ready(function() {
    if ($(".owl-thumb-pro").exists()) {
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
    }
})
