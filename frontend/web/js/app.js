$(document).ready(function () {

    $("#carousel").owlCarousel({

        autoPlay: 3000,
        items: 1,
        itemsDesktop: [1000, 1], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 1], // betweem 900px and 601px
        itemsTablet: [768, 1], //2 items between 600 and 0
        itemsMobile: false, // itemsMobile disabled - inherit from itemsTablet option
        navigation: true,
        navText: ['<span class="glyphicon glyphicon-chevron-left">', '<span class="glyphicon glyphicon-chevron-left">']

    });
});