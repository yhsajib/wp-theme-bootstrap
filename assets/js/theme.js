;(function ($) {
    "use strict";
    var scroll_top;
    var window_height;
    var window_width;
    var scroll_status = '';
    var lastScrollTop = 0;
    $( document ).ready( function() {
        setTimeout(function() {
            $('.tilt-hover').each(function () {
                $(this).tilt({
                    easing:"cubic-bezier(.03,.98,.52,.99)",
                    perspective: 1200,
                    speed: 700,
                })
            });
        }, 300);

        //* Main Theme Functions
        yhsshu_header_sticky();
        yhsshu_open_menu_toggle();
        yhsshu_panel_mobile_menu();
        yhsshu_panel_anchor_toggle();
        yhsshu_sidebar_tabs_toggle();
        yhsshu_document_click();
        yhsshu_scroll_to_top();
        yhsshu_footer_fixed();
        yhsshu_magnific_popup();
        yhsshu_scroll_to_id();
        yhsshu_update_post_share();
        yhsshu_backtotop_progress_bar();

        //* For Element
        yhsshu_element_parallax();
        yhsshu_fancyBoxAccordion();
        yhsshu_svgDrawing();
        yhsshu_yhsshuCursor();

        //* For Shop
        yhsshu_shop_view_layout();
        yhsshu_single_product_handler();
        yhsshu_wc_single_product_gallery();
        yhsshu_mini_cart_dropdown_offset();
        yhsshu_update_cart_quantity();

        yhsshu_quickview_handler();
    });
    $(window).on('load', function () {
        setTimeout(function() {
            $('#yhsshu-loadding.default').addClass('preloaded');
        }, 800);
        $("#yhsshu-loadding.content-image").fadeOut("slow");
        setTimeout(function() {
            $('#yhsshu-loadding').remove();
            $('.yhsshu-cursor').css("visibility", "visible");

            if ($('.animation').length > 0) {
                const observer = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animated');
                        }
                    });
                });
                observer.observe(document.querySelector('.animation'));
            }
        }, 3000);
    });
    $(window).on('scroll', function () {
        scroll_top = $(window).scrollTop();
        window_height = $(window).height();
        window_width = $(window).width();
        if (scroll_top < lastScrollTop) {
            scroll_status = 'up';
        } else {
            scroll_status = 'down';
        }
        lastScrollTop = scroll_top;
        
        yhsshu_header_sticky();
        yhsshu_scroll_to_top();
        yhsshu_sticky_position();
    });
    $( document.body ).on( 'wc_fragments_loaded wc_fragments_refreshed', function() {
        $('body').find('.yhsshu-cart-dropdown').removeClass('loading');
        $('body').removeClass('loading');
    });
    $( document ).on( 'click', '.yhsshu-anchor-cart .yhsshu-anchor', function( e ) {
        e.preventDefault();
        e.stopPropagation();
        var target = $(this).attr('data-target');
        if( target == '.yhsshu-cart-dropdown'){
            $(this).next(target).toggleClass('open');    
        }else{
            $(target).toggleClass('open');
            $('.yhsshu-page-overlay').toggleClass('active');   
            $('.product-main-img .yhsshu-cursor-icon').addClass('hide'); 
        }
    });

    function yhsshu_header_sticky() {
        'use strict';
        
        if($(document).find('.yhsshu-header-sticky').length > 0 && window_width >= 1200){
            var header_height = $('.yhsshu-header-desktop').outerHeight();

            var offset_top_animation = header_height + 150;

            if (scroll_status == 'up' && scroll_top > offset_top_animation) {
                $(document).find('.yhsshu-header-sticky').addClass('h-fixed');
            } else {
                $(document).find('.yhsshu-header-sticky').removeClass('h-fixed');
                $(document).find('.yhsshu-header-sticky .yhsshu-cart-dropdown').removeClass('open');
            }
        }

        if($(document).find('.yhsshu-header-main-sticky').length > 0 && window_width >= 1200){
            let tl = gsap.timeline({
                defaults: {
                    duration: 0.2
                }
            });
            var header_height = $('.yhsshu-header-desktop').outerHeight();
            var main_sticky_height = $('.yhsshu-header-main-sticky').outerHeight();
            if( scroll_top > (header_height + main_sticky_height) ){    
                if (scroll_status == 'down' && $('.yhsshu-header').hasClass('sticky-direction-scroll-down') ) {
                    $(document).find('.yhsshu-header-main-sticky').addClass('h-fixed');
                    tl.to('.yhsshu-header-main-sticky', {
                        y: 0
                    });
                }else if( scroll_status == 'up' && $('.yhsshu-header').hasClass('sticky-direction-scroll-up') ){
                    $(document).find('.yhsshu-header-main-sticky').addClass('h-fixed');
                    tl.to('.yhsshu-header-main-sticky', {
                        y: 0
                    });
                }else if( $('.yhsshu-header').hasClass('sticky-direction-scroll') ){
                    $(document).find('.yhsshu-header-main-sticky').addClass('h-fixed');
                    tl.to('.yhsshu-header-main-sticky', {
                        y: 0
                    });
                }else{
                    tl.to('.yhsshu-header-main-sticky', {
                        y: (main_sticky_height * -1)
                    });
                }
            }else{
                $(document).find('.yhsshu-header-main-sticky').removeClass('h-fixed');
                tl.to('.yhsshu-header-main-sticky', {
                    y: 0
                });
            }
        } 

        if ( $(document).find('.yhsshu-header-mobile-sticky').length > 0 && window_width < 1200  ) {
            var offset_top = $('.yhsshu-header-mobile').outerHeight();
            offset_top = $('.yhsshu-header-mobile-transparent').length > 0 ? (offset_top + $('.yhsshu-header-mobile-transparent').outerHeight()) : offset_top;
            if (scroll_status == 'down' && $('.yhsshu-header').hasClass('sticky-direction-scroll-down') && scroll_top > offset_top) {
                $(document).find('.yhsshu-header-mobile-sticky').addClass('mh-fixed');
            } else if (scroll_status == 'up' && $('.yhsshu-header').hasClass('sticky-direction-scroll-up') && scroll_top > offset_top) {
                $(document).find('.yhsshu-header-mobile-sticky').addClass('mh-fixed');
            } else {
                $(document).find('.yhsshu-header-mobile-sticky').removeClass('mh-fixed');
            }
        }

        if ( $(document).find('.yhsshu-header-mobile-main-sticky').length > 0 && window_width < 1200  ) {
            let timel = gsap.timeline({
                defaults: {
                    duration: 0.2
                }
            });
            var offset_top = $('.yhsshu-header-mobile').outerHeight();
            var mobile_main_sticky_height = $('.yhsshu-header-mobile-main-sticky').outerHeight();
            if( scroll_top > (offset_top + mobile_main_sticky_height) ){    
                if (scroll_status == 'down' && $('.yhsshu-header').hasClass('sticky-direction-scroll-down')) {
                    $(document).find('.yhsshu-header-mobile-main-sticky').addClass('mh-fixed');
                    timel.to('.yhsshu-header-mobile-main-sticky', {
                        y: 0
                    });
                }else if( scroll_status == 'up' && $('.yhsshu-header').hasClass('sticky-direction-scroll-up') ){
                    $(document).find('.yhsshu-header-mobile-main-sticky').addClass('mh-fixed');
                    timel.to('.yhsshu-header-mobile-main-sticky', {
                        y: 0
                    });    
                }else{
                    timel.to('.yhsshu-header-mobile-main-sticky', {
                        y: (mobile_main_sticky_height * -1)
                    });
                }
            } else {
                $(document).find('.yhsshu-header-mobile-main-sticky').removeClass('mh-fixed');
                timel.to('.yhsshu-header-mobile-main-sticky', {
                    y: 0
                });
            }
        }

        if ( $(document).find('.yhsshu-header-mobile-transparent-sticky').length > 0 && window_width < 1200  ) {
            let timel = gsap.timeline({
                defaults: {
                    duration: 0.2
                }
            });
            var offset_top = $('.yhsshu-header-mobile').outerHeight();
            var mobile_main_sticky_height = $('.yhsshu-header-mobile-transparent-sticky').outerHeight();
            if( scroll_top > (offset_top + mobile_main_sticky_height + 1) ){    
                if (scroll_status == 'down' && $('.yhsshu-header').hasClass('sticky-direction-scroll-down')) {
                    $(document).find('.yhsshu-header-mobile-transparent-sticky').addClass('mh-fixed');
                    timel.to('.yhsshu-header-mobile-transparent-sticky', {
                        y: 0
                    });
                }else if( scroll_status == 'up' && $('.yhsshu-header').hasClass('sticky-direction-scroll-up') ){
                    $(document).find('.yhsshu-header-mobile-transparent-sticky').addClass('mh-fixed');
                    timel.to('.yhsshu-header-mobile-transparent-sticky', {
                        y: 0
                    });     
                }else{
                    timel.to('.yhsshu-header-mobile-transparent-sticky', {
                        y: (mobile_main_sticky_height * -1)
                    });
                }
            }else{
                $(document).find('.yhsshu-header-mobile-transparent-sticky').removeClass('mh-fixed');
                timel.to('.yhsshu-header-mobile-transparent-sticky', {
                    y: 0
                });
            }
        }
    }

    function yhsshu_sticky_position(){
        if ($('.yhsshu-header-sticky.h-fixed').length > 0) {
            var headerStickyHeight = $(document).find('.yhsshu-header-sticky.h-fixed').height();
            if ($('body.admin-bar').length > 0)
                $(document).find('.sidebar-sticky .sidebar-sticky-wrap').css('top', headerStickyHeight + 60 + 'px');
            else 
            $(document).find('.sidebar-sticky .sidebar-sticky-wrap').css('top', headerStickyHeight + 30 + 'px');           
        }
        else if ($('body.admin-bar').length > 0)
            $(document).find('.sidebar-sticky .sidebar-sticky-wrap').css('top', 60 + 'px');
        else
            $(document).find('.sidebar-sticky .sidebar-sticky-wrap').css('top', 30 + 'px');    
    }

    function yhsshu_open_menu_toggle(){
        'use strict';
        //* Add toggle button to parent Menu
        $('.sub-menu .current-menu-item').parents('.menu-item-has-children').addClass('current-menu-ancestor');
        $('.is-arrow .yhsshu-primary-menu > li.menu-item-has-children').append('<span class="main-menu-toggle"></span>');
        $('.yhsshu-mobile-menu li.menu-item-has-children').append('<span class="main-menu-toggle"></span>');
        $('.yhsshu-custom-menu li.menu-item-has-children > a').append('<span class="main-menu-toggle"></span>');
        $('.main-menu-toggle').on('click', function () {
            $(this).toggleClass('open');
            $(this).closest('li').find('> .sub-menu').toggleClass('submenu-open');
            $(this).closest('li').find('> .sub-menu').slideToggle();
        });

        //* Menu Dropdown
        var $menu = $('.yhsshu-main-navigation');
        $menu.find('.yhsshu-primary-menu li').each(function () {
            var $submenu = $(this).find('> ul.sub-menu');
            if ($submenu.length == 1) {
                $(this).on('mouseover', function () {
                    if ($submenu.offset().left + $submenu.width() > $(window).width()) {
                        $submenu.addClass('back');
                    } else if ($submenu.offset().left < 0) {
                        $submenu.addClass('back');
                    }
                });
                $(this).on('mouseleave', function () {
                    $submenu.removeClass('back');
                });
            }
        });
    }

    function yhsshu_panel_mobile_menu(){
        'use strict';
        $(document).on('click','.btn-nav-mobile',function(e){
            e.preventDefault();
            e.stopPropagation();
            var target = $(this).attr('data-target');
            $(this).toggleClass('clicked');
            $(target).toggleClass('open');
            $('.yhsshu-page-overlay').toggleClass('active');
        });
    }

    function yhsshu_panel_anchor_toggle(){
        'use strict';
        $(document).on('click','.yhsshu-anchor.side-panel',function(e){
            e.preventDefault();
            e.stopPropagation();
            var target = $(this).attr('data-target');
            $(this).toggleClass('clicked');
            $(target).toggleClass('open');
            $('.yhsshu-page-overlay').toggleClass('active');
            $(document).find('.yhsshu-header-sticky').removeClass('h-fixed');
            setTimeout(function(){
                $('.yhsshu-search-form input[name="s"]').focus();
            },1000);
        });

        $(document).on('click','.yhsshu-anchor-cart.cart_anchor',function(e){
            e.preventDefault();
            e.stopPropagation();
            var target = $(this).attr('data-target');
            $(target).toggleClass('open');
            $(document).find('.yhsshu-header-sticky').removeClass('h-fixed');
        });
    }
    
    function yhsshu_sidebar_tabs_toggle(){
        'use strict';
        $(".anchor-inner-item").first().addClass('active');
        $(document).on('click','.yhsshu-sidebar-tabs .anchor-link-item',function(e){
            e.preventDefault();
            e.stopPropagation();
            var target = $(this).attr('data-target');
            $(target).addClass('active').siblings().removeClass('active');
        });
    }

    function yhsshu_document_click(){
        'use strict';
        $(document).on('click',function (e) {
            var target = $(e.target);
            var check = '.btn-nav-mobile, .yhsshu-anchor.side-panel, .yhsshu-anchor-cart.yhsshu-anchor, .yhsshu-anchor-cart.yhsshu-anchor, .btn-shop-sidebar-hidden-toggle, .mfp-woosq .mfp-close, .woosw-popup .woosw-popup-close';

            if (!(target.is(check)) && target.closest('.yhsshu-hidden-template').length <= 0 && $('.yhsshu-page-overlay').length <= 0) {
                $('.btn-nav-mobile').removeClass('clicked');
                $('.yhsshu-hidden-template').removeClass('open');
                $('.yhsshu-page-overlay').removeClass('active');
            }

            if ( !(target.is('.yhsshu-anchor-cart.yhsshu-anchor')) && target.closest('.yhsshu-cart-dropdown').length <= 0 ) {  
                $('.yhsshu-cart-dropdown').removeClass('open');
            }

            if (!(target.is(check)) && target.closest('.sidebar-shop').length <= 0 && target.closest('.yhsshu-hidden-template').length <= 0 && $('.yhsshu-page-overlay').hasClass('active')) { 
                $('.yhsshu-hidden-template').removeClass('open');
                $('.sidebar-shop').removeClass('open');
                $('.yhsshu-page-overlay').removeClass('active');
            }

            if ( $('.yhsshu-hidden-template.pos-center').length > 0 && $('.yhsshu-hidden-template.pos-center').hasClass('open') && target.closest('.yhsshu-hidden-template.pos-center .yhsshu-hidden-template-wrap').length <= 0 ) {  
                $('.yhsshu-hidden-template').removeClass('open');
                $('.yhsshu-page-overlay').removeClass('active');
            }
        });
        $(document).on('click', '.yhsshu-close', function(e){
            e.preventDefault();
            e.stopPropagation();
            $(this).closest('.yhsshu-hidden-template').toggleClass('open');
            $('.btn-nav-mobile').removeClass('clicked');
            $('.yhsshu-page-overlay').toggleClass('active');
            $('.yhsshu-anchor.side-panel').removeClass('clicked');
        });
    }

    //* Scroll To Top
    function yhsshu_scroll_to_top() {
        if (scroll_top < window_height) {
            $('.yhsshu-scroll-top').addClass('off').removeClass('on');
        }
        if (scroll_top > window_height) {
            $('.yhsshu-scroll-top').addClass('on').removeClass('off');
        }
        $('.yhsshu-scroll-top').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $('html, body').stop().animate({scrollTop: 0}, 800);
        });
    }

    //* Scroll To ID
    function yhsshu_scroll_to_id() {
        if ($('.yhsshu-links').length == 0) return;
        const sections = document.querySelectorAll("section[id]");
        window.addEventListener("scroll", navHighlighter);
        function navHighlighter() {
            let scrollY = window.pageYOffset;
            sections.forEach(current => {
                const sectionHeight = current.offsetHeight;
                const sectionTop = current.offsetTop - 50;
                const sectionId = current.getAttribute("id");
                if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight && document.querySelector("a[href*=" + sectionId + "]")){
                    document.querySelector("a[href*=" + sectionId + "]").classList.add("active");
                } else if (document.querySelector("a[href*=" + sectionId + "]")) {
                    document.querySelector("a[href*=" + sectionId + "]").classList.remove("active");
                }
            });
        };
    }

    //* Footer Fixed
    function yhsshu_footer_fixed() {
        setTimeout(function(){
            var h_footer = $('.yhsshu-footer-fixed .footer-type-el').outerHeight() - 1;
            $('.yhsshu-footer-fixed #yhsshu-main').css('margin-bottom', h_footer + 'px');
        }, 600);
    }

    //* Update Post Share
    function yhsshu_update_post_share() {
        $('.single-post .social-share .social-item').on('click', function(){
            var id = document.querySelector('.status-publish').getAttribute('id').replace("post-", "");
            if (id) {
                $.ajax({
                    url: main_data.ajaxurl,
                    type: 'POST',
                    cache: false,
                    data: {
                        action: 'yhsshu_set_post_share',
                        post_id: id
                    }
                });
            }
        });
    }

    //* Video Popup
    function yhsshu_magnific_popup() {
        $('a.media-play-button').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });

        /* Images Light Box - Gallery:True */
        $('.images-light-box').each(function () {
            $(this).magnificPopup({
                delegate: 'a.light-box',
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade',
            });
        });

        /* Gallery Image URL */
        $('a.gallery-image-popup').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade gallery-popup',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
        });
    }

    // Element Parallax
    function yhsshu_element_parallax() {
        let delSections = document.querySelectorAll(".yhsshu-element-parallax");
        delSections.forEach(section => {
            var el_data = section.getAttribute('data-parallax');
            var el_data_obj = JSON.parse(el_data);
            let imageAnim = gsap.to(section.querySelector("img"), {
                x: el_data_obj.x,
                y: el_data_obj.y,
                ease: "none",
                paused: true
            });
            let progressTo = gsap.quickTo(imageAnim, "progress", {ease: "ease-out", duration: parseFloat(section.dataset.scrub) || 0.2});

            gsap.to(section.querySelector(".elementor-widget-container"), {
                x: "0",
                y: "0",
                ease: "none",
                scrollTrigger: {
                    scrub: true,
                    trigger: section,
                    onUpdate: self => progressTo(self.progress)
                }
            });
        });
    }

    // FancyBox Accordion
    function yhsshu_fancyBoxAccordion() {
        var widgetList = jQuery('.yhsshu-fancy-box-accordion');
        if (!widgetList.length) {
            return;
        }
        widgetList.each(function () {
            var itemClass = '.box-item';
            jQuery(this)
            .find(itemClass + ':first-child')
            .addClass('active');
            jQuery(this)
            .find(itemClass)
            .on('mouseover', function () {
                jQuery(this).addClass('active').siblings().removeClass('active');
            });
        });
    }

    // Svg Drawing
    function yhsshu_svgDrawing() {
        $(".svg-drawing").each(function(){
            var $selector = jQuery(this);
            $(window).scroll(function() {
                var hT = $selector.offset().top,
                hH = $selector.outerHeight(),
                wH = $(window).height(),
                wS = $(this).scrollTop();
                if (wS > (hT-wH)){
                    $selector.find('.drawing').each(function () {
                        let path = $(this).get(0);
                        let length = path.getTotalLength();
                        path.style.strokeDasharray = length;
                        path.style.strokeDashoffset = length;
                    });
                    $selector.addClass('dr-start');
                }
            });

        });
    }

    // yhsshu Cursor
    function yhsshu_yhsshuCursor() {
        $(document).ready(function(){
            $(".yhsshu-cursor").each(function(index) {
                var cms_cursor = $(this);
                gsap.set(cms_cursor, {xPercent: -50, yPercent: -50});
                var pos = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
                var mouse = { x: pos.x, y: pos.y };
                var speed = 0.4;

                var xSet = gsap.quickSetter(cms_cursor, "x", "px");
                var ySet = gsap.quickSetter(cms_cursor, "y", "px");

                window.addEventListener("mousemove", e => {
                    mouse.x = e.x;
                    mouse.y = e.y;
                });

                gsap.ticker.add(() => {
                    var dt = 1.0 - Math.pow(1.0 - speed, gsap.ticker.deltaRatio());

                    pos.x += (mouse.x - pos.x) * dt;
                    pos.y += (mouse.y - pos.y) * dt;
                    xSet(pos.x);
                    ySet(pos.y);
                });

                $("*").on("mouseenter", function(e) {
                    var currentCursor = $(this).css('cursor') ;
                    if (currentCursor == "pointer"){
                        cms_cursor.addClass("active");
                    }
                });
                
                $("*").on("mouseleave", function(e) {
                    var currentCursor = $(this).css('cursor') ;
                    if (currentCursor == "pointer"){
                        cms_cursor.removeClass("active");
                    }
                });
            });
        });
    }

    function yhsshu_shop_view_layout(){
        $(document).on('click', '.yhsshu-view-layout .view-icon a', function(e){
            e.preventDefault();
            if (!$(this).parent('li').hasClass('active')){
                $('.yhsshu-view-layout .view-icon').removeClass('active');
                $(this).parent('li').addClass('active');
                $(this).parents('.yhsshu-content-area').find('.products').removeAttr('class').addClass($(this).attr('data-cls'));
            }
        });
    }

    function yhsshu_single_product_handler(){
        $(document).on('click','.quantity .quantity-button',function () {
            var $this = $(this),
            spinner = $this.closest('.quantity'),
            input = spinner.find('input[type="number"]'),
            step = input.attr('step'),
            min = input.attr('min'),
            max = input.attr('max'),value = parseInt(input.val());
            if(!value) value = 0;
            if(!step) step=1;
            step = parseInt(step);
            if (!min) min = 0;
            var type = $this.hasClass('quantity-up') ? 'up' : 'down' ;
            switch (type)
            {
            case 'up':
                if(!(max && value >= max))
                    input.val(value+step).change();
                break;
            case 'down':
                if (value > min)
                    input.val(value-step).change();
                break;
            }
            if(max && (parseInt(input.val()) > max))
                input.val(max).change();
            if(parseInt(input.val()) < min)
                input.val(min).change();
        });
    }

    function debounce(fn, wait) {
        var timeout;
        return function() {
            var context = this;
            var args = arguments;

            clearTimeout(timeout);

            timeout = setTimeout(function() {
                fn.apply(context, args);
            }, wait);
        };
    };

    function yhsshu_update_cart_quantity(){
        $('.cart-list-wrapper').on( 'change', '.qty', function() {
            var item_key = $( this ).attr( 'name' );
            var item_qty = $( this ).val(); 
            var data = {
                action: 'yhsshu_update_product_quantity',
                cart_item_key: item_key,
                cart_item_qty: item_qty,
                security: main_data.nonce,
            };
            $.ajax( {
                url: main_data.ajaxurl,
                type: 'POST',
                cache: false,
                dataType: 'json',
                data: data,
                success: function( response ) {  
                    $( document.body ).trigger( 'wc_fragment_refresh' );
                    $( document.body ).trigger( 'yhsshu_update_qty', [ item_key, item_qty ] );
                },
                beforeSend: function() {
                    $('body').addClass('loading');
                },
                complete: function() {}
            } );
        });
        $('.widget_shopping_cart').on( 'change', '.qty', function() {
            var item_key = $( this ).attr( 'name' );
            var item_qty = $( this ).val();
            var data = {
                action: 'yhsshu_update_product_quantity',
                cart_item_key: item_key,
                cart_item_qty: item_qty,
                security: main_data.nonce,
            };
            $.ajax( {
                url: main_data.ajaxurl,
                type: 'POST',
                cache: false,
                dataType: 'json',
                data: data,
                success: function( response ) {  
                    $( document.body ).trigger( 'wc_fragment_refresh' );
                    $( document.body ).trigger( 'yhsshu_update_qty', [ item_key, item_qty ] );
                },
                beforeSend: function() {
                    $('.widget_shopping_cart .yhsshu-widget-cart-content').addClass('loading');
                },
            } );
        });
        $('.yhsshu-sticky-atc').on( 'change', '.qty', function() {
            var item_key = $( this ).attr( 'name' );
            var item_qty = $( this ).val(); 
            if( parseInt(item_qty) > 0){
                $(this).closest('.yhsshu-sticky-atc').find('.add_to_cart_button').attr('data-quantity',item_qty);
            }
        });
    }

    function yhsshu_mini_cart_dropdown_offset(){
        if( $( '.yhsshu-cart-dropdown' ).length > 0 ){
            var window_w = $(window).width();
            $( '.yhsshu-cart-dropdown' ).each(function(index, el) {
                var anchor_cart_offset_right = $(this).closest('.yhsshu-anchor-cart').offset().left;
                if ( ($(this).offset().left + $(this).width() ) > window_w) {
                    var right_offset = window_w - (anchor_cart_offset_right + $(this).closest('.yhsshu-anchor-cart').width()) - 15;
                    $(this).css('right', (right_offset * -1));
                }
            });

        }
    }

    function yhsshu_wc_single_product_gallery(){
        'use strict';
        if(typeof $.flexslider != 'undefined'){
            $('.wc-gallery-sync').each(function() {
                var itemW      = parseInt($(this).attr('data-thumb-w')),
                itemH      = parseInt($(this).attr('data-thumb-h')),
                itemN      = parseInt($(this).attr('data-thumb-n')),
                itemMargin = parseInt($(this).attr('data-thumb-margin')),
                window_w = $(window).outerWidth(),
                itemSpace  = itemH - itemW + itemMargin;
                var gallery_layout = window_w > 575 ? 'vertical' : 'horizontal';

                if($(this).hasClass('thumbnail-vertical')){
                    $(this).flexslider({
                        selector       : '.wc-gallery-sync-slides > .wc-gallery-sync-slide',
                        animation      : 'slide',
                        controlNav     : false,
                        directionNav   : true,
                        prevText       : '<span class="flex-prev-icon"></span>',
                        nextText       : '<span class="flex-next-icon"></span>',
                        asNavFor       : '.woocommerce-product-gallery',
                        direction      : gallery_layout,
                        slideshow      : false,
                        animationLoop  : false,
                        itemWidth      : itemW, // add thumb image height
                        itemMargin     : itemSpace, // need it to fix transform item
                        move           : 1,
                        start: function(slider){
                            var asNavFor     = slider.vars.asNavFor,
                            height       = $(asNavFor).height(),
                            height_thumb = $(asNavFor).find('.flex-viewport').height();
                            if(window_w > 575) {
                                slider.css({'max-height' : height_thumb, 'overflow': 'hidden'});
                                slider.find('> .flex-viewport > *').css({'height': height, 'width': ''});
                            }
                        }
                    });
                }
                if($(this).hasClass('thumbnail-horizontal')){
                    $(this).flexslider({
                        selector       : '.wc-gallery-sync-slides > .wc-gallery-sync-slide',
                        animation      : 'slide',
                        controlNav     : false,
                        directionNav   : false,
                        prevText       : '<span class="flex-prev-icon"></span>',
                        nextText       : '<span class="flex-next-icon"></span>',
                        asNavFor       : '.woocommerce-product-gallery',
                        slideshow      : false,
                        animationLoop  : false, // Breaks photoswipe pagination if true.
                        itemWidth      : itemW,
                        itemMargin     : itemMargin,
                        start: function(slider){

                        }
                    });
                };
            });
        }
    }

    function yhsshu_table_cart_content(){
        "use strict";
        var table = jQuery('.woocommerce-cart-form__contents'),
        table_head = table.find('thead');
        table_head.find('.product-remove').remove();
        table_head.find('.product-thumbnail').remove();
        table_head.find('.product-name').attr('colspan',2);
        table_head.find('tr').append('<th class="product-remove">&nbsp;</th>');
    }

    function yhsshu_quickview_handler() {
        $('.yhsshu-quickview').on('click', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product_id');
            $.ajax({
                url: main_data.ajaxurl,
                type: 'POST',
                data: {
                    action: 'yhsshu_product_quickview',
                    product_id: product_id
                },
                success: function(response) {
                    $('#yhsshu-quickview-modal .modal-content').html(response);
                    $('#yhsshu-quickview-modal').addClass('open');
                }
            });
        });
        // Close the modal when clicking the close button
        $(document).on('click', '.close-modal', function() {
            $('#yhsshu-quickview-modal').removeClass('open');
        });
        // Close the modal when clicking outside the modal content
        $(window).on('click', function(event) {
            if ($(event.target).is('#yhsshu-quickview-modal')) {
                $('#yhsshu-quickview-modal').removeClass('open');
            }
        });
    }

    function yhsshu_backtotop_progress_bar() {
        if($('.yhsshu-scroll-top.sushi, .yhsshu-scroll-top.custom-style-1, .yhsshu-scroll-top.custom-style-2').length > 0) {
            var progressPath = document.querySelector('.yhsshu-scroll-top path');
            var pathLength = progressPath.getTotalLength();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
            progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
            progressPath.style.strokeDashoffset = pathLength;
            progressPath.getBoundingClientRect();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';      
            var updateProgress = function () {
                var scroll = $(window).scrollTop();
                var height = $(document).height() - $(window).height();
                var progress = pathLength - (scroll * pathLength / height);
                progressPath.style.strokeDashoffset = progress;
            }
            updateProgress();
            $(window).scroll(updateProgress);   
            var offset = 50;
            var duration = 550;
            $(window).on('scroll', function() {
                if ($(this).scrollTop() > offset) {
                    $('.yhsshu-scroll-top').addClass('active-progress');
                } else {
                    $('.yhsshu-scroll-top').removeClass('active-progress');
                }
            });
        }
    }

})(jQuery);