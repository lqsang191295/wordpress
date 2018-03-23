(function( $ ) {
    'use strict';

    // MI TESTIMONIAL OWL CAROUSEL
    $(document).ready(function(){

        var global_owl_options = {
            themeClass: 'mi-owl-theme',
            baseClass: 'mi-owl-carousel',
            itemClass: 'mi-owl-item',
            navContainerClass: 'mi-owl-nav',
            controlsClass: 'mi-owl-controls',
            dotClass: 'mi-owl-dot',
            dotsClass: 'mi-owl-dots',
            autoHeightClass: 'mi-owl-height',
            navClass: ['mi-owl-prev', 'mi-owl-next'],
            navText: ['<i class="mi-testimonial-icon-left-open"></i>', '<i class="mi-testimonial-icon-right-open"></i>']
        };

        var carousels = $(".mi-testimonial .mi-owl-carousel");
        if( carousels.length > 0 ) {
            carousels.each(function(){
                if ( $(this).children().length < 2 ) {
                    return false;
                }
                var options = $(this).data('owl-options');
                options = (options) ? options : {};
                var config = $.extend({}, global_owl_options, options);

                var owlCar = $(this).miOwlCarousel( config );
                
                owlCar.on('changed.owl.carousel', function(event) {

                    var $thumbLinks = $(this).closest('.mi-testimonial-container').find('.mi-testimonial-carousel-trigger > ul > li');

                    if ( $thumbLinks ) {

                        var count = event.item.count;
                        var index = event.item.index;
                        var $clonedItems = $(event.currentTarget).find('.mi-owl-item.cloned');
                        var sideLength = $clonedItems.length/2;
                        var mainIndex = 0;

                        if( index < count+sideLength ) {
                            mainIndex = index - sideLength;
                        } else {
                            mainIndex = 0;
                        }

                        if( mainIndex < 0 ) {
                            mainIndex = count - 1;
                        }

                        $thumbLinks.eq(mainIndex).addClass('mi-testimonial-carousel-active-trigger').siblings('li').removeClass('mi-testimonial-carousel-active-trigger');
                        
                    }

                });
            });
        }

        $('.mi-testimonial-carousel-trigger ul li a').on('click', function(e){
            e.preventDefault();
            
            var $parent = $(this).parent();
            var index = $parent.index();
            var $carousel = $(this).closest('.mi-testimonial').find('.mi-owl-carousel');
            var carousel_data = $carousel.miOwlCarousel();
            
            carousel_data.trigger('to.owl.carousel', [index, 300, true]);

        });

    });

})( jQuery );
