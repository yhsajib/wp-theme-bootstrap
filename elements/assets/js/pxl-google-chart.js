( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */

    'use strict';
    var yhsshuGoogleChartHandler = function( $scope, $ ) {
        $scope.find(".yhsshu-google-chart").each(function(){
            var $this = $(this);
            var wrap_element = $this.children('.chart-div')[0];
            /* Chart Data */
            var chart_data = '[' + decodeURIComponent($this.attr('data-datas')) + ']';
            chart_data = chart_data.replace(/'/g, '"');
            chart_data = chart_data.replace(/,}/g, '}');
            /* Chart Options */
            var chart_options = '{' + decodeURIComponent($this.attr('data-options')) + '}';
            chart_options = chart_options.replace(/'/g, '"');
            chart_options = chart_options.replace(/,}/g, '}');
            var jsonStr = chart_options.replace(/(\w+:)|(\w+ :)/g, function(s) {
                return '"' + s.substring(0, s.length-1) + '":';
            });
            var objOptions = JSON.parse(jsonStr);
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable(JSON.parse(chart_data));
                var options = objOptions;

                switch ($this.attr('data-type')) {
                    case 'Area':
                        var chart_area = new google.visualization.AreaChart(wrap_element);
                        chart_area.draw(data, options);
                        break;
                    case 'Pie':
                        var chart_pie = new google.visualization.PieChart(wrap_element);
                        chart_pie.draw(data, options);
                        break;
                    case 'Line':
                        var chart_line = new google.visualization.LineChart(wrap_element);
                        chart_line.draw(data, options);
                        break;
                    case 'Combo':
                        var chart_combo = new google.visualization.ComboChart(wrap_element);
                        chart_combo.draw(data, options);
                        break;
                    default:
                        break;
                }
            }
        });
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/yhsshu_google_chart.default', yhsshuGoogleChartHandler );
    } );
} )( jQuery );