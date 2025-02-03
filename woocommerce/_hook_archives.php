<?php
/* Number of products per page (shop page) */
add_filter( 'loop_shop_per_page', 'yhsshu_loop_shop_per_page', 20 );
function yhsshu_loop_shop_per_page( $limit ) {
    $limit = yhsshu()->get_theme_opt('shop_archive_product_per_page', 9);
    return $limit;
}

function yhsshu_wc_shortcode_products_has_paginate(){
    return wc_get_loop_prop( 'is_shortcode' ) && wc_get_loop_prop( 'is_paginated' );
}

/* Remove page title on archive page */
add_filter('woocommerce_show_page_title', function(){ return false;});

/* Replace text On-sale */
add_filter('woocommerce_sale_flash', 'yhsshu_custom_sale_text', 10, 3);
function yhsshu_custom_sale_text($text, $post, $_product)
{
    $onsale_text = yhsshu()->get_theme_opt('onsale_text', 'Sale Off');
    return '<span class="onsale">'.esc_attr($onsale_text).'</span>';
}

/* Add and Remove function hook in woocommerce/templates/content-product.php */
function yhsshu_woocommerce_remove_loop_function() {
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
    remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash', 10);
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
}
add_action( 'init', 'yhsshu_woocommerce_remove_loop_function' );

/* Custom Top table: catalog order and result count */
if(!function_exists('yhsshu_woocommerce_catalog_result')){
    // remove
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    // add back
    add_action('woocommerce_before_shop_loop','yhsshu_woocommerce_catalog_result', 20);
    add_action('yhsshu_woocommerce_catalog_ordering', 'woocommerce_catalog_ordering');
    add_action('yhsshu_woocommerce_result_count', 'woocommerce_result_count');
    function yhsshu_woocommerce_catalog_result(){
        $columns = isset($_GET['col']) ? sanitize_text_field($_GET['col']) : yhsshu()->get_theme_opt('products_columns', '2');
        $display_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : yhsshu()->get_theme_opt('shop_display_type', 'grid');
        $active_grid = 'active';
        $active_list = '';
        if( $display_type == 'list' ){
            $active_list = $display_type == 'list' ? 'active' : '';
            $active_grid = '';
        }
        $row_cols_class = yhsshu_get_shop_loop_row_column_class();
        $style_shop = yhsshu()->get_theme_opt('product_layout', 'layout-1');
        ?>
        <div class="yhsshu-shop-topbar-wrap row justify-content-between align-items-center g-30">
            <?php if ($style_shop == 'layout-1' || $style_shop == 'layout-2' || $style_shop == 'layout-5' || $style_shop == 'layout-7' || $style_shop == 'layout-11' || $style_shop == 'layout-12') : ?>
                <div class="yhsshu-view-layout-wrap col-12 col-sm-auto order-md-3">
                    <ul class="yhsshu-view-layout d-flex align-items-center">
                        <li class="lbl"><?php echo esc_html__( 'View', 'yhsshu' ); ?></li>
                        <li class="view-icon view-grid <?php echo esc_attr($active_grid) ?>"><a href="javascript:void(0);" class="yhsshu-ttip tt-top-left" data-cls="products <?php echo implode(' ', $row_cols_class);?>" data-col="grid"><span class="tt-txt"><?php echo esc_html__('View Grid','yhsshu') ?></span><span class="yhsshui-grid"></span></a></li>
                        <li class="view-icon view-list <?php echo esc_attr($active_list) ?>"><a href="javascript:void(0);" class="yhsshu-ttip tt-top-left" data-cls="products shop-view-list" data-col="list"><span class="tt-txt"><?php echo esc_html__('View List','yhsshu') ?></span><span class="yhsshui-list"></span></a></li>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="col-12 col-sm-auto order-md-2">
                <?php do_action('yhsshu_woocommerce_catalog_ordering'); ?>
            </div>
            <div class="col text-heading number-result">
                <?php do_action('yhsshu_woocommerce_result_count'); ?>
            </div>
        </div>
        <?php
    }
}

/* Cart Button */
add_filter('woocommerce_loop_add_to_cart_link', 'yhsshu_woocommerce_loop_add_to_cart_link', 10, 3);
add_filter( 'woocommerce_add_to_cart_form_action', '__return_empty_string' );
function yhsshu_woocommerce_loop_add_to_cart_link($button, $product, $args){
    if (class_exists( 'YITH_WAPO' ) && !empty(YITH_WAPO_DB()->yith_wapo_get_blocks_by_product($product->get_id()))) {
        return '<a href="#" class="yhsshu-btn button yhsshu-quickview" data-product_id="' . get_the_ID() . '">' . esc_html__('Order Online', 'yhsshu') . '</a>';
    }

    $product_layout = yhsshu()->get_theme_opt('product_layout', 'layout-1');
    $btn_icon = '<span class="yhsshu-icon yhsshui-shopping-bag-2"></span>';
    if ($product_layout == 'layout-3' || $product_layout == 'layout-4') {
        $btn_icon = '';
    }
    else if ($product_layout == 'layout-5' || $product_layout == 'layout-7' || $product_layout == 'layout-9') {
        $btn_icon = '<span class="yhsshu-icon yhsshui yhsshui-shopping-cart-plus"></span>';
    }
    return sprintf(
        '<a href="%s" data-quantity="%s" class="yhsshu-btn %s" %s><span class="yhsshu-btn-text">%s</span>%s</a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
        esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
        isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
        esc_html( $product->add_to_cart_text() ),
        $btn_icon
    );
}

/* Paginate links */
add_filter('woocommerce_pagination_args', 'yhsshu_woocommerce_pagination_args');
function yhsshu_woocommerce_pagination_args($default){
    $default = array_merge($default, [
        'prev_text' => '<span class="yhsshui-angle-double-left"></span>',
        'next_text' => '<span class="yhsshui-angle-double-right"></span>',
        'type'      => 'plain',
    ]);
    return $default;
}


/* Product Quickview */

function yhsshu_product_quickview() {
    $product_id = intval(sanitize_text_field($_POST['product_id']));
    $product = wc_get_product($product_id);
    ob_start();
    ?>
    <h3 class="modal-heading">
        <span><?php echo esc_html('Product Options', 'yhsshu'); ?></span>
        <span class="close-modal"></span>
    </h3>
    <div class="woocommerce single-product">
        <div id="product-<?php echo esc_attr( $product_id ); ?>" <?php wc_product_class( '', $product ); ?>>
            <div class="row gx-0">
                <div class="content-left col-md-5 col-12">
                    <div class="product-content">
                        <h3 class="product-title"><?php echo esc_html($product->get_name()); ?></h3>
                        <div class="product-price"><?php yhsshu_print_html($product->get_price_html()); ?></div>
                        <div class="yhsshu-divider"></div>
                        <div class="product-description"><?php echo esc_html($product->get_short_description()); ?></div>     
                    </div>
                    <div class="product-images"><?php yhsshu_print_html($product->get_image()); ?></div>
                </div>
                <div class="content-right col-md-7 col-12">
                    <?php
                    global $product;
                    $product = wc_get_product($product_id);
                    switch ($product->get_type()) {
                        case 'variable':
                        yhsshu_variable_add_to_cart();
                        break;
                        case 'external':
                        yhsshu_external_add_to_cart(); 
                        break;
                        case 'grouped':
                        yhsshu_grouped_add_to_cart(); 
                        break;
                        default:
                        yhsshu_simple_add_to_cart(); 
                        break;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    wp_die();
    echo ob_get_clean();
}

add_action('wp_ajax_nopriv_yhsshu_product_quickview', 'yhsshu_product_quickview');
add_action('wp_ajax_yhsshu_product_quickview', 'yhsshu_product_quickview');

function add_quickview_modal() {
    $quickview_style = yhsshu()->get_theme_opt('quick_view_style', 'style-1');
    ?>
    <div id="yhsshu-quickview-modal" class="custom-modal <?php echo esc_attr($quickview_style); ?>">
        <div class="modal-content"></div>
    </div>
    <?php
}
add_action('wp_footer', 'add_quickview_modal');