/*-------------------------------------------------------------------------------
	  header slider
	-------------------------------------------------------------------------------*/
if ($('.hero-carousel').length) {
    $('.hero-carousel').owlCarousel({
        animateOut: 'fadeOutUp',
        animateIn: 'fadeInUp',
        autoplay: true,
        autoplayTimeout: 3000,
        loop: true,
        margin: 30,
        items: 1,
        nav: false,
        dots: false,
        responsiveClass: true,
        // animateOut: 'fadeOut',
        slideSpeed: 1000,
        smartSpeed:450,
        paginationSpeed: 1000
    })
}

if ($('.about-carousel').length) {
    $('.about-carousel').owlCarousel({
        animateOut: 'fadeOutLeft',
        animateIn: 'fadeInRight',
        autoplay: true,
        autoplayTimeout: 3000,
        loop: true,
        margin: 30,
        items: 1,
        nav: false,
        dots: false,
        responsiveClass: true,
        // animateOut: 'fadeOut',
        slideSpeed: 1000,
        smartSpeed:450,
        paginationSpeed: 1000
    })
}


/*-------------------------------------------------------------------------------
	  featured slider
	-------------------------------------------------------------------------------*/
if ($('.featured-carousel').length) {
    $('.featured-carousel').owlCarousel({
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        loop: true,
        margin: 10,
        items: 1,
        nav: true,
        dots: false,
        responsiveClass: true,
        slideSpeed: 300,
        paginationSpeed: 500,
        responsive: {
            768: {
                items: 2
            },
            1100: {
                items: 4
            }
        }
    })
}


/*-------------------------------------------------------------------------------
   	  admin preview slider
   	-------------------------------------------------------------------------------*/
$('.admin-slider').owlCarousel({
    loop: false,

    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 5
        }
    }
})
