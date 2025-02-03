<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $woocommerce_loop;
$display_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : yhsshu()->get_theme_opt('shop_display_type', 'grid');

if ($woocommerce_loop['name'] == 'related') {
    $row_cols_class = yhsshu_get_shop_loop_row_column_class([
        'col_xs'  => '1',
        'col_sm'  => '1',
        'col_md'  => '2', 
        'col_lg'  => '2',
        'col_xl'  => '3',
        'col_xxl' => '3'
    ]);    
}

else {
    $row_cols_class = yhsshu_get_shop_loop_row_column_class();
}

if ($display_type == 'list') {
    ?> <div class="products shop-view-list"> <?php
} else {
    ?> <div class="products <?php echo implode(' ', $row_cols_class); ?>"> <?php
}