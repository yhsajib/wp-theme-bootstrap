( function( $ ) {
    // Make sure you run this code under Elementor.
    'use strict';
    if( typeof Swiper == 'undefined') return;
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction("frontend/element_ready/pxl_team_carousel.default", function($scope) {
            pxl_swiper_handler($scope);
        });
        elementorFrontend.hooks.addAction("frontend/element_ready/pxl_menu_carousel.default", function($scope) {
            pxl_swiper_handler($scope);
        });
        elementorFrontend.hooks.addAction("frontend/element_ready/pxl_post_carousel.default", function($scope) {
            pxl_swiper_handler($scope);
        });
        elementorFrontend.hooks.addAction("frontend/element_ready/pxl_testimonial_carousel.default", function($scope) {
            pxl_swiper_handler($scope);
        });
        elementorFrontend.hooks.addAction("frontend/element_ready/pxl_fancy_box_carousel.default", function($scope) {
            pxl_swiper_handler($scope);
        });
        elementorFrontend.hooks.addAction("frontend/element_ready/pxl_banner_carousel.default", function($scope) {
            pxl_swiper_handler($scope);
        });
        elementorFrontend.hooks.addAction("frontend/element_ready/pxl_clients.default", function($scope) {
            pxl_swiper_handler($scope);
        });
        elementorFrontend.hooks.addAction("frontend/element_ready/pxl_history.default", function($scope) {
            pxl_swiper_handler($scope);
        });
        elementorFrontend.hooks.addAction("frontend/element_ready/pxl_video_slider.default", function($scope) {
            pxl_swiper_handler($scope);
        });
        elementorFrontend.hooks.addAction("frontend/element_ready/pxl_carousel_landing.default", function($scope) {
            pxl_swiper_handler($scope);
        });
        elementorFrontend.hooks.addAction("frontend/element_ready/pxl_image_carousel.default", function($scope) {
            pxl_swiper_handler($scope);
        });
        elementorFrontend.hooks.addAction("frontend/element_ready/pxl_product_carousel.default", function($scope) {
            pxl_swiper_handler($scope);
        });
    });

    $( document ).ready( function() {
        $('.pxl-theme-carousel').each(function() {
            pxl_swiper_handler($(this));
        });
        pxl_swiper_handler( $('.product-loop-carousel') );
        pxl_swiper_handler( $('.pxl-product-swiper-slider') );
        pxl_swiper_handler( $('.pxl-product-loop-carousel .pxl-product-carousel') );
    });

    $(document).ajaxComplete(function(event, xhr, settings){  
        "use strict";
        pxl_swiper_handler( $('.product-loop-carousel') );     
    });

    function pxl_swiper_handler($scope){

        var $carousel_dom = $scope.find('.pxl-swiper-slider');
        if( $scope.hasClass('pxl-swiper-slider') )
            $carousel_dom = $scope;

        $carousel_dom.each(function(index, element) { 
            var $this = $(this);
            var settings = $this.find('.pxl-swiper-container').data().settings; 
            
            var next_el = $this.find('.pxl-swiper-arrow-next')[0];
            var prev_el = $this.find('.pxl-swiper-arrow-prev')[0]; 
            var dots_el = $this.find('.pxl-swiper-dots')[0];

            if( $this.hasClass('swiper-parent')){
                settings = $this.find('.pxl-swiper-container.swiper-parent').data().settings;
                next_el = $this.find('.pxl-swiper-arrow-next.swiper-parent')[0];
                prev_el = $this.find('.pxl-swiper-arrow-prev.swiper-parent')[0];
                dots_el = $this.find('.pxl-swiper-dots.swiper-parent')[0];
            }

            if( $this.find('.pxl-swiper-slider-thumbs .pxl-swiper-arrows').length > 0){
                next_el = [$this.find('.pxl-swiper-arrow-next')[0], $this.find('.pxl-swiper-arrow-next')[1]];
                prev_el = [$this.find('.pxl-swiper-arrow-prev')[0], $this.find('.pxl-swiper-arrow-prev')[1]]; 
            }
            if( $this.find('.pxl-swiper-slider-thumbs .pxl-swiper-dots').length > 0){
                dots_el = [$this.find('.pxl-swiper-dots')[0], $this.find('.pxl-swiper-dots')[1]];
            }

            var carousel_settings = {
                direction: settings['slide_direction'],
                effect: settings['slide_mode'],
                wrapperClass : 'pxl-swiper-wrapper',
                slideClass: 'pxl-swiper-slide',
                slidesPerView: settings['slides_to_show'],
                slidesPerGroup: settings['slides_to_scroll'],
                slidesPerColumn: settings['slide_percolumn'],
                spaceBetween: parseInt(settings['slides_gutter']),
                autoplayDisableOnInteraction: false,
                lazy: true,
                navigation: {
                    nextEl: next_el,
                    prevEl: prev_el,
                },
                pagination: {
                    type: settings['dots_style'],
                    el: dots_el,
                    clickable : true,
                    modifierClass: 'pxl-swiper-pagination-',
                    bulletClass : 'pxl-swiper-pagination-bullet',
                    renderCustom: function (swiper, element, current, total) {
                        return current + ' of ' + total;
                    }
                },
                speed: parseInt(settings['speed']),
                watchSlidesProgress: true,
                watchSlidesVisibility: true,
                observer: true,
                observeParents: true,
                breakpoints: {
                    0 : {
                        slidesPerView: settings['slides_to_show_xs'],
                        slidesPerGroup: settings['slides_to_scroll'],
                    },
                    576 : {
                        slidesPerView: settings['slides_to_show_sm'],
                        slidesPerGroup: settings['slides_to_scroll'],
                    },
                    768 : {
                        slidesPerView: settings['slides_to_show_md'],
                        slidesPerGroup: settings['slides_to_scroll'],
                    },
                    992 : {
                        slidesPerView: settings['slides_to_show_lg'],
                        slidesPerGroup: settings['slides_to_scroll'],
                    },
                    1200 : {
                        slidesPerView: settings['slides_to_show'],
                        slidesPerGroup: settings['slides_to_scroll'],
                        spaceBetween: parseInt(settings['slides_gutter']),
                    },
                    1400 : {
                        slidesPerView: settings['slides_to_show_xxl'],
                        slidesPerGroup: settings['slides_to_scroll'],
                        spaceBetween: parseInt(settings['slides_gutter']),
                    }
                },
                on: {
                    init : function (swiper){
                        $this.find('.swiper-slide .pxl-animate').each(function(){
                            var data = $(this).data('settings');
                            $(this).removeClass('animated '+data['animation']).addClass('pxl-invisible');
                        });
                        $this.find('.pxl-swiper-slide .pxl-animate').each(function(){
                            var data = $(this).data('settings');
                            var cur_anm = $(this);
                            setTimeout(function () {  
                                $(cur_anm).removeClass('pxl-invisible').addClass('animated ' + data['animation']);
                            }, data['animation_delay']);

                        });
                        $this.find('.pxl-bd-anm').each(function(){
                            $(this).addClass('pxl-animated');
                        });
                        $this.find('.swiper-slide .pxl-init-invisible').each(function(){
                            $(this).addClass('pxl-animated');
                        });
                        if (settings['auto_height']) setSlideHeight(this);
                    },
                    slideChangeTransitionStart : function (swiper){
                        var activeIndex = this.activeIndex;
                    },
                    slideChangeTransitionEnd : function(){
                        if (settings['auto_height']) setSlideHeight(this);
                    },
                    slideChange: function (swiper) {
                        $this.find('.swiper-slide .pxl-animate').each(function(){
                            var data = $(this).data('settings');
                            $(this).removeClass('animated '+data['animation']).addClass('pxl-invisible');
                        });
                        $this.find('.pxl-swiper-slide .pxl-animate').each(function(){
                            var data = $(this).data('settings');
                            var cur_anm = $(this);
                            setTimeout(function () {  
                                $(cur_anm).removeClass('pxl-invisible').addClass('animated ' + data['animation']);
                            }, data['animation_delay']);

                        }); 
                        $this.find('.pxl-bd-anm').each(function(){
                            $(this).addClass('pxl-animated');
                        });
                    },
                },
            };

            //center slide
            if(settings['center_slide'])
                carousel_settings['centeredSlides'] = true;

            if(settings['auto_height'])
                carousel_settings['auto_height'] = true;

            // loop
            if(settings['loop']){
                carousel_settings['loop'] = true;
            }
            // auto play
            if(settings['autoplay']){
                carousel_settings['autoplay'] = {
                    delay : settings['delay'],
                    disableOnInteraction : settings['pause_on_interaction']
                };
            } else {
                carousel_settings['autoplay'] = false;
            }

            if(settings['slides_gutter_lg']){
                carousel_settings['breakpoints'][0]['spaceBetween'] = parseInt(settings['slides_gutter_lg']);
                carousel_settings['breakpoints'][576]['spaceBetween'] = parseInt(settings['slides_gutter_lg']);
                carousel_settings['breakpoints'][768]['spaceBetween'] = parseInt(settings['slides_gutter_lg']);
                carousel_settings['breakpoints'][992]['spaceBetween'] = parseInt(settings['slides_gutter_lg']);
            }

            if(settings['slides_gutter_md']){
                carousel_settings['breakpoints'][0]['spaceBetween'] = parseInt(settings['slides_gutter_md']);
                carousel_settings['breakpoints'][576]['spaceBetween'] = parseInt(settings['slides_gutter_md']);
                carousel_settings['breakpoints'][768]['spaceBetween'] = parseInt(settings['slides_gutter_md']);
            }

            
            if($this.find('.pxl-swiper-thumbs').length > 0){  
                var thumb_carousel_settings = pxl_get_thumbs_setting($this.find('.pxl-swiper-thumbs'));
                thumb_carousel_settings['slideThumbActiveClass'] = 'swiper-slide-thumb-active';
                thumb_carousel_settings['thumbsContainerClass'] = 'swiper-container-thumbs';
                
                var slide_thumbs = new Swiper($this.find('.pxl-swiper-thumbs')[0], thumb_carousel_settings);

                slide_thumbs.on('resize', function () {
                    slide_thumbs.changeDirection(getDirection($this.find('.pxl-swiper-thumbs')));
                });

                carousel_settings['thumbs'] = { swiper: slide_thumbs, autoScrollOffset: 1 };

            }
            
            //initial swiper
            var swiper = new Swiper($this.find('.pxl-swiper-container')[0], carousel_settings);

            if(settings['autoplay'] && settings['pause_on_hover'] ){
                $( $this.find('.pxl-swiper-container') ).on({
                    mouseenter: function mouseenter() {
                        //this.swiper.autoplay.stop();
                        swiper.autoplay.stop();
                    },
                    mouseleave: function mouseleave() {
                        //this.swiper.autoplay.start();
                        swiper.autoplay.start();
                    }
                });
            }

            function setSlideHeight(that){
                $('.swiper-slide').css({height:'auto'});
                var currentSlide = that.activeIndex;
                var newHeight = $(that.slides[currentSlide]).height();

                $('.swiper-wrapper, .swiper-slide').css({ height : newHeight })
                that.update();
            }

            $this.find(".swiper-filter-wrap .filter-item").on("click", function(){
                var target = $(this).attr('data-filter-target');
                var parent = $(this).closest('.pxl-swiper-slider');
                $(this).siblings().removeClass("active");
                $(this).addClass("active");

                if(target == "all"){
                    parent.find("[data-filter]").removeClass("non-swiper-slide").addClass("swiper-slide");
                    swiper.destroy();
                    swiper = new Swiper($this.find('.pxl-swiper-container')[0], carousel_settings);

                }else {

                    parent.find(".swiper-slide").not("[data-filter^='"+target+"'], [data-filter*=' "+target+"']").addClass("non-swiper-slide").removeClass("swiper-slide");
                    parent.find("[data-filter^='"+target+"'], [data-filter*=' "+target+"']").removeClass("non-swiper-slide").addClass("swiper-slide");
                    
                    swiper.destroy();
                    swiper = new Swiper($this.find('.pxl-swiper-container')[0], carousel_settings);
                }
            });

            if ($(this).hasClass('layout-post-3') || $(this).hasClass('layout-post-4') || $(this).hasClass('layout-post-8')) {
                $(this).find('.swiper-slide').each(function() {
                    var excerptHeight = $(this).find('.item-excerpt').get(0).scrollHeight;
                    var imageHeight = $(this).find('.post-image').outerHeight();
                    $(this).find('.item-excerpt').css('max-height', '0px');
                    $(this).find('.post-image').css('max-height', imageHeight + 'px');
                    
                    $(this).on('mouseover', function() {
                        $(this).find('.item-excerpt').css('max-height', excerptHeight + 'px');
                        $(this).find('.post-image').css('max-height', (imageHeight - (excerptHeight  + 14)) + 'px');
                    });

                    $(this).on('mouseleave', function() {
                        $(this).find('.item-excerpt').css('max-height', '0px');
                        $(this).find('.post-image').css('max-height', imageHeight + 'px');
                    });
                });
            }
        });
    }

    function getDirection($thumb_node) {
        var windowWidth = window.innerWidth;
        var thumbs_settings = $thumb_node.data().settings;
        var direction = (window.innerWidth <= 991 && typeof thumbs_settings['slide_direction_mobile'] !== 'undefined' ) ? thumbs_settings['slide_direction_mobile'] : thumbs_settings['slide_direction'];

        return direction;
    }

    function pxl_get_thumbs_setting($thumb_node){  
        var thumbs_settings = $thumb_node.data().settings, 
        thumbs_settings_params = {
            direction: getDirection($thumb_node),
            effect: thumbs_settings['slide_mode'],
            wrapperClass : 'pxl-thumbs-wrapper',
            slideClass: 'pxl-swiper-slide',
            slidesPerView: thumbs_settings['slides_to_show'],
            slidesPerGroup: thumbs_settings['slides_to_scroll'],
            slidesPerColumn: thumbs_settings['slide_percolumn'],
            spaceBetween: thumbs_settings['slides_gutter'],
            speed: parseInt(thumbs_settings['speed']),
            watchSlidesProgress: true,
            watchSlidesVisibility: true,
            observer: true,
            observeParents: true,
            breakpoints: {
                0 : {
                    slidesPerView: thumbs_settings['slides_to_show_xs'],
                    slidesPerGroup: thumbs_settings['slides_to_scroll'],
                },
                576 : {
                    slidesPerView: thumbs_settings['slides_to_show_sm'],
                    slidesPerGroup: thumbs_settings['slides_to_scroll'],
                },
                768 : {
                    slidesPerView: thumbs_settings['slides_to_show_md'],
                    slidesPerGroup: thumbs_settings['slides_to_scroll'],
                },
                992 : {
                    slidesPerView: thumbs_settings['slides_to_show_lg'],
                    slidesPerGroup: thumbs_settings['slides_to_scroll'],
                },
                1200 : {
                    slidesPerView: thumbs_settings['slides_to_show'],
                    slidesPerGroup: thumbs_settings['slides_to_scroll'],
                    spaceBetween: thumbs_settings['slides_gutter'],
                },
                1400 : {
                    slidesPerView: thumbs_settings['slides_to_show_xxl'],
                    slidesPerGroup: thumbs_settings['slides_to_scroll'],
                    spaceBetween: thumbs_settings['slides_gutter'],
                }
            },
        };

        if(thumbs_settings['allow_touch_move'] == false)
            thumbs_settings_params['allowTouchMove'] = false;

        if(thumbs_settings['center_slide'] || thumbs_settings['center_slide'] == 'true')
            thumbs_settings_params['centeredSlides'] = true;

                // loop
        if(thumbs_settings['loop'] || thumbs_settings['loop'] === 'true'){
            thumbs_settings_params['loop'] = true;
        }
                // auto play
        if(thumbs_settings['autoplay'] || thumbs_settings['autoplay'] === 'true'){
            thumbs_settings_params['autoplay'] = {
                delay : thumbs_settings['delay'],
                disableOnInteraction : thumbs_settings['pause_on_interaction']
            };
        } else {
            thumbs_settings_params['autoplay'] = false;
        }

        if(thumbs_settings['slides_gutter_md']){
            thumbs_settings_params['breakpoints'][0]['spaceBetween'] = parseInt(thumbs_settings['slides_gutter_md']);
            thumbs_settings_params['breakpoints'][576]['spaceBetween'] = parseInt(thumbs_settings['slides_gutter_md']);
            thumbs_settings_params['breakpoints'][768]['spaceBetween'] = parseInt(thumbs_settings['slides_gutter_md']);
        }
        if(thumbs_settings['slides_gutter_lg']){
            thumbs_settings_params['breakpoints'][0]['spaceBetween'] = parseInt(thumbs_settings['slides_gutter_lg']);
            thumbs_settings_params['breakpoints'][576]['spaceBetween'] = parseInt(thumbs_settings['slides_gutter_lg']);
            thumbs_settings_params['breakpoints'][768]['spaceBetween'] = parseInt(thumbs_settings['slides_gutter_lg']);
            thumbs_settings_params['breakpoints'][992]['spaceBetween'] = parseInt(thumbs_settings['slides_gutter_lg']);
        }
        return thumbs_settings_params;
    }
})( jQuery );