
    jQuery(document).ready(function() {
        jQuery('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 1,
                    nav: false
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: false,
                    margin: 20
                }
            }
        })
    });


jQuery(document).ready(function(){

        jQuery(".wi-filter-button").click(function(){
            var value = jQuery(this).attr('data-filter');

            if(value == "all")
            {
                //$('.filter').removeClass('hidden');
                jQuery('.filter').show('1000');
            }
            else
            {
//            $('.filter[filter-wi-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-wi-item="'+value+'"]').addClass('hidden');
                jQuery(".filter").not('.'+value).hide('3000');
                jQuery('.filter').filter('.'+value).show('3000');

            }
        });

    });


