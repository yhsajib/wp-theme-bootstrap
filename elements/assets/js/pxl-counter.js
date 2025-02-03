( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    'use strict';
    var PXLCounterHandler = function( $scope, $ ) {
        setTimeout(function(){
            elementorFrontend.waypoint($scope.find('.pxl-counter-number-value'), function () {
                var $number = $(this),
                    data = $number.data();
                var el = $number[0];
                var startNumber = data['startnumber'], endNumber = data['endnumber'], separator = data['delimiter'], duration = data['duration'] ;
                var od = new Odometer({
                    el: el,
                    value: startNumber,
                    format: separator,
                    theme: 'default',
                    minIntegerLen: 2
                });
                od.update(endNumber);
            });
        }, 150);
    };
    var PXLCounterOldHandler = function( $scope, $ ) {
        setTimeout(function(){
            elementorFrontend.waypoint($scope.find('.pxl-counter-value'), function () {
                var $number = $(this),
                    data = $number.data();

                var decimalDigits = data.toValue.toString().match(/\.(.*)/);

                if (decimalDigits) {
                    data.rounding = decimalDigits[1].length;
                }
                $number.numerator(data);
            }, {
                offset: '95%',
                triggerOnce: true
            });
        }, 150);
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_counter.default', PXLCounterHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_pie_chart.default', PXLCounterOldHandler );
    } );
} )( jQuery );