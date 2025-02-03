( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */

    'use strict';
    var yhsshuAccordionHandler = function( $scope, $ ) {
        $scope.find(".yhsshu-accordion .yhsshu-ac-item .yhsshu-ac-title").on("click", function(e){
            e.preventDefault();
            var target = $(this).data("target");
            var parent = $(this).parents(".yhsshu-accordion");
            var active_items = parent.find(".yhsshu-ac-title.active");
            $.each(active_items, function (index, item) {
                var item_target = $(item).data("target");
                if(item_target != target){
                    $(item).removeClass("active");
                    $(this).parent().removeClass("active");
                    $(item_target).slideUp(400);
                }
            });
            $(this).parent().toggleClass("active");
            $(this).toggleClass("active");
            $(target).slideToggle(400);
        });
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/yhsshu_accordion.default', yhsshuAccordionHandler );
    } );
} )( jQuery );