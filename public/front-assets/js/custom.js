var $ = jQuery.noConflict();

jQuery(document).ready(function($) {



   if ($('.cars-category-slider').length > 0) {
    jQuery('.cars-category-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        infinite: true,
        centerMode: false,
        autoplay: false,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
}


$('button[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
  $('.cars-category-slider').slick('refresh');
})


    if ($('.cars-compare-slider').length > 0) {
    jQuery('.cars-compare-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        infinite: true,
        centerMode: false,
        autoplay: false,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 991, // below 1200px
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768, // below 768px
                settings: {
                    slidesToShow: 1,
                    arrows: true, // hide arrows on mobile
                    dots: false      // enable dots for mobile
                }
            }
        ]
    });
}

    if ($('.car-details-slider').length > 0) {
    jQuery('.car-details-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        infinite: true,
        centerMode: false,
        autoplay: false,
        autoplaySpeed: 3000,
    });
}





    $(document).ready(function() {
        $('.trending-cars-slider').slick({
            variableWidth: true, // <-- variable width (acts like auto width)
            arrows: true, // <-- arrows enabled
            dots: false, // <-- dots disabled
            infinite: true,
            slidesToScroll: 1,
            adaptiveHeight: true,
            // optional: change behaviour on small screens
            responsive: [{
                breakpoint: 600,
                settings: {
                    variableWidth: true, // make slides full-width on narrow screens
                }
            }]
        });
    });


    /*==========================*/
    /* Scroll on animate */
    /*==========================*/
    function onScrollInit(items, trigger) {
        items.each(function() {
            var osElement = $(this),
                osAnimationClass = osElement.attr('data-os-animation'),
                osAnimationDelay = osElement.attr('data-os-animation-delay');
            osElement.css({
                '-webkit-animation-delay': osAnimationDelay,
                '-moz-animation-delay': osAnimationDelay,
                'animation-delay': osAnimationDelay
            });
            var osTrigger = (trigger) ? trigger : osElement;
            osTrigger.waypoint(function() {
                osElement.addClass('animated').addClass(osAnimationClass);
            }, {
                triggerOnce: true,
                offset: '95%',
            });
            // osElement.removeClass('fadeInUp');
        });
    }
    onScrollInit($('.os-animation'));
    onScrollInit($('.staggered-animation'), $('.staggered-animation-container'));


    /*==========================*/
    /* Header fix */
    /*==========================*/
    var scroll = $(window).scrollTop();
    if (scroll >= 10) {
        $("body").addClass("fixed");
    } else {
        $("body").removeClass("fixed");
    }


    // Off-canvas filters (mobile)
    var $drawer = $('#filtersDrawer');
    var $backdrop = $('#filtersBackdrop');
    $('#openFilters').on('click', function(e) {
        e.preventDefault();
        $drawer.addClass('open').attr('aria-hidden', 'false');
        $backdrop.addClass('show');
        $('body').addClass('no-scroll');
    });
    $('#closeFilters, #filtersBackdrop').on('click', function(e) {
        e.preventDefault();
        $drawer.removeClass('open').attr('aria-hidden', 'true');
        $backdrop.removeClass('show');
        $('body').removeClass('no-scroll');
    });
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && $drawer.hasClass('open')) {
            $('#closeFilters').trigger('click');
        }
    });

});


$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 10) {
        $("body").addClass("fixed");
    } else {
        $("body").removeClass("fixed");
    }
});


// Radio button tabs functionality
$('.radio-tab input[type="radio"]').on('change', function() {
    // Remove active class from all tabs
    $('.radio-tab').removeClass('active');

    // Add active class to selected tab
    $(this).closest('.radio-tab').addClass('active');

    // Show corresponding tab content
    const target = $(this).data('bs-target');
    $('.tab-pane').removeClass('show active');
    $(target).addClass('show active');
});


// $('select').niceSelect();
$('select:not(.ignore)').niceSelect()

/* Model Year dual-range control */
$(function() {
    var $min = $('#yearMin');
    var $max = $('#yearMax');
    if (!$min.length || !$max.length) return;

    var minAttr = parseInt($min.attr('min'), 10);
    var maxAttr = parseInt($max.attr('max'), 10);
    var $labels = { min: $('#yearMinLabel'), max: $('#yearMaxLabel') };
    var $dual = $min.closest('.dual-range');

    function clampValues() {
        var vMin = parseInt($min.val(), 10);
        var vMax = parseInt($max.val(), 10);
        if (vMin > vMax) {
            var tmp = vMin; vMin = vMax; vMax = tmp;
            $min.val(vMin); $max.val(vMax);
        }
        $labels.min.text(vMin);
        $labels.max.text(vMax);
        var left = ((vMin - minAttr) / (maxAttr - minAttr)) * 100;
        var right = ((vMax - minAttr) / (maxAttr - minAttr)) * 100;
        $dual.css({'--left': left + '%', '--right': right + '%'});
    }

    $min.on('input change', clampValues);
    $max.on('input change', clampValues);
    clampValues();
});