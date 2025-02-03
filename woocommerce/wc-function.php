<?php
function yhsshu_get_shop_loop_row_column_class($args = []){

    $col_xxl = isset($_GET['col_xxl']) ? $_GET['col_xxl'] : ( !empty($args['col_xxl']) ? $args['col_xxl'] : yhsshu()->get_theme_opt('products_col_xxl', 4) );
    $col_xl  = isset($_GET['col_xl']) ? $_GET['col_xl'] : ( !empty($args['col_xl']) ? $args['col_xl'] : yhsshu()->get_theme_opt('products_col_xl', 3) );
    $col_lg  = isset($_GET['col_lg']) ? $_GET['col_lg'] : ( !empty($args['col_lg']) ? $args['col_lg'] : yhsshu()->get_theme_opt('products_col_lg', 3) );
    $col_md  = isset($_GET['col_md']) ? $_GET['col_md'] : ( !empty($args['col_md']) ? $args['col_md'] : yhsshu()->get_theme_opt('products_col_md', 3) );
    $col_sm  = isset($_GET['col_sm']) ? $_GET['col_sm'] : ( !empty($args['col_sm']) ? $args['col_sm'] : yhsshu()->get_theme_opt('products_col_sm', 2) );
    $col_xs  = isset($_GET['col_xs']) ? $_GET['col_xs'] : ( !empty($args['col_xs']) ? $args['col_xs'] : yhsshu()->get_theme_opt('products_col_xs', 2) );


    $col_xxl = 'row-cols-xxl-'.$col_xxl;
    $col_xl  = 'row-cols-xl-'.$col_xl;
    $col_lg  = 'row-cols-lg-'.$col_lg;
    $col_md  = 'row-cols-md-'.$col_md;
    $col_sm  = 'row-cols-sm-'.$col_sm;
    $col_xs  = 'row-cols-xs-'.$col_xs;

    return [$col_xs, $col_sm, $col_md, $col_lg, $col_xl, $col_xxl];
}

function yhsshu_get_grid_gutter_x_class($option_name, $is_single = false){
    $gutter_x_theme_opt = yhsshu()->get_theme_opt($option_name, []);
    $g_x_cls = $g_x = $gxi = [];
    for($i = 0; $i <= 6; $i++){
        if( !empty($gutter_x_theme_opt[$i]) )
            $gxi[$i] = $gutter_x_theme_opt[$i];
    }
    if( $is_single ){
        $gutter_x = yhsshu()->get_page_opt($option_name, []);
        if( empty($gutter_x) || ( !empty($gutter_x) && count($gutter_x) == 1 && empty($gutter_x[0]) ) ){
            $g_x = $gxi;
        }else{
            $g_x = $gutter_x;
        }
    }else{
        $g_x = $gxi;
    }

    foreach ($g_x as $key => $value) {
        switch ($key) {
            case 0:
                $breakpoint = '';
                break;
            case 1:
                $breakpoint = 'xs-';
                break;
            case 2:
                $breakpoint = 'sm-';
                break;
            case 3:
                $breakpoint = 'md-';
                break;
            case 4:
                $breakpoint = 'lg-';
                break;
            case 5:
                $breakpoint = 'xl-';
                break;
            case 6:
                $breakpoint = 'xxl-';
                break;
            default:
                $breakpoint = '';
                break;
        }
        if(!empty($value))
            $g_x_cls[$key] = 'gx-'.$breakpoint.$value;
    }
    return $g_x_cls;
}

function yhsshu_get_grid_gutter_y_class($option_name, $is_single = false){
    $gutter_y_theme_opt = yhsshu()->get_theme_opt($option_name, []);
    $g_y_cls = $g_y = $gyi = [];
    for($i = 0; $i <= 6; $i++){
        if( !empty($gutter_y_theme_opt[$i]) )
            $gyi[$i] = $gutter_y_theme_opt[$i];
    }
    if( $is_single ){
        $gutter_y = yhsshu()->get_page_opt($option_name, []);
        if( empty($gutter_y) || ( !empty($gutter_y) && count($gutter_y) == 1 && empty($gutter_y[0]) ) ){
            $g_y = $gyi;
        }else{
            $g_y = $gutter_y;
        }
    }else{
        $g_y = $gyi;
    }

    foreach ($g_y as $key => $value) {
        switch ($key) {
            case 0:
                $breakpoint = '';
                break;
            case 1:
                $breakpoint = 'xs-';
                break;
            case 2:
                $breakpoint = 'sm-';
                break;
            case 3:
                $breakpoint = 'md-';
                break;
            case 4:
                $breakpoint = 'lg-';
                break;
            case 5:
                $breakpoint = 'xl-';
                break;
            case 6:
                $breakpoint = 'xxl-';
                break;
            default:
                $breakpoint = '';
                break;
        }
        if(!empty($value))
            $g_y_cls[$key] = 'gy-'.$breakpoint.$value;
    }
    return $g_y_cls;
}

function yhsshu_wc_cart_totals_shipping_method_label( $method ) {
    $label     = $method->get_label();
    $has_cost  = 0 < $method->cost;
    $hide_cost = ! $has_cost && in_array( $method->get_method_id(), array( 'free_shipping', 'local_pickup' ), true );

    if ( $has_cost && ! $hide_cost ) {
        if ( WC()->cart->display_prices_including_tax() ) {
            $label .= ' (' . wc_price( $method->cost + $method->get_shipping_tax() ).')';
            if ( $method->get_shipping_tax() > 0 && ! wc_prices_include_tax() ) {
                $label .= ' <small class="tax_label">' . WC()->countries->inc_tax_or_vat() . '</small>';
            }
        } else {
            $label .= ' (' . wc_price( $method->cost ).')';
            if ( $method->get_shipping_tax() > 0 && wc_prices_include_tax() ) {
                $label .= ' <small class="tax_label">' . WC()->countries->ex_tax_or_vat() . '</small>';
            }
        }
    }

    return apply_filters( 'woocommerce_cart_shipping_method_full_label', $label, $method );
}