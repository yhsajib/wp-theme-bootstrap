( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var PxlCircleTextHandler = function( $scope, $ ) {
        if ($scope.find(".pxl-circle-text .circle-text").length > 0) {
            const $circleTextElement = $scope.find(".pxl-circle-text .circle-text");
            let textContent = $circleTextElement.text().trim();

            const middleIndex = Math.floor(textContent.length / 2);
            const textWithDots = `${textContent.slice(0, middleIndex)} • ${textContent.slice(middleIndex)} •`;
            $circleTextElement.text(textWithDots);

            new CircleType($circleTextElement[0]);
        }
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_circle_text.default', PxlCircleTextHandler );
    } );
} )( jQuery );