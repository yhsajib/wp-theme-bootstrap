<?php 
add_filter( 'woocommerce_enqueue_styles', 'yhsshu_remove_wc_styles' );
function yhsshu_remove_wc_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

/* Product Search form */
add_filter( 'get_product_search_form', 'yhsshu_product_search_form', 10, 1 );
function yhsshu_product_search_form($form){
    ob_start();
    ?>
    <form method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'yhsshu' ); ?></label>
        <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search Product&hellip;', 'yhsshu' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'yhsshu' ); ?>"><?php echo esc_html_x( 'Search', 'submit button', 'yhsshu' ); ?></button>
        <input type="hidden" name="post_type" value="product" />
    </form>
    <?php 
    $form = ob_get_clean();
    return $form;
}
add_filter( 'wc_get_template', 'yhsshu_wc_update_get_template', 10, 5 );
function yhsshu_wc_update_get_template($template, $template_name, $args, $template_path, $default_path){

    switch ($template_name) {
        case 'loop/loop-start.php':
            $template = get_stylesheet_directory().'/'.WC()->template_path().'loop/yhsshu-loop-start.php';
            break;
        case 'loop/loop-end.php':
            $template = get_template_directory().'/'.WC()->template_path().'loop/yhsshu-loop-end.php';
            break;
        case 'single-product/related.php':
            $template = get_template_directory().'/'.WC()->template_path().'single-product/yhsshu-related.php';
            break;
        case 'cart/mini-cart.php':
            $template = get_template_directory().'/'.WC()->template_path().'cart/yhsshu-mini-cart.php';
            break;
        case 'cart/cart-empty.php':
            $template = get_template_directory().'/'.WC()->template_path().'cart/yhsshu-cart-empty.php';
            break;
        case 'content-widget-product.php':
            $template = get_template_directory().'/'.WC()->template_path().'yhsshu-content-widget-product.php';
            break;
        case 'content-widget-price-filter.php':
            $template = get_template_directory().'/'.WC()->template_path().'yhsshu-content-widget-price-filter.php';
            break;
        case 'loop/pagination.php':
            $template = get_template_directory().'/'.WC()->template_path().'loop/yhsshu-pagination.php';
            break;
        case 'global/quantity-input.php':
            $template = get_template_directory().'/'.WC()->template_path().'global/yhsshu-quantity-input.php';
            break;
        case 'cart/cart.php':
            $template = get_template_directory().'/'.WC()->template_path().'cart/yhsshu-cart.php';
            break;
        case 'cart/cart-totals.php':
            $template = get_template_directory().'/'.WC()->template_path().'cart/yhsshu-cart-totals.php';
            break;
        case 'cart/cart-shipping.php':
            $template = get_template_directory().'/'.WC()->template_path().'cart/yhsshu-cart-shipping.php';
            break;
        case 'cart/shipping-calculator.php':
            $template = get_template_directory().'/'.WC()->template_path().'cart/yhsshu-shipping-calculator.php';
            break;
        case 'checkout/form-checkout.php':
            $template = get_stylesheet_directory().'/'.WC()->template_path().'checkout/yhsshu-form-checkout.php';
            break;
        case 'checkout/form-login.php':
            $template = get_template_directory().'/'.WC()->template_path().'checkout/yhsshu-form-login.php';
            break;
        case 'global/form-login.php':
            $template = get_template_directory().'/'.WC()->template_path().'global/yhsshu-form-login.php';
            break;
        case 'checkout/form-coupon.php':
            $template = get_template_directory().'/'.WC()->template_path().'checkout/yhsshu-form-coupon.php';
            break;
        case 'checkout/form-billing.php':
            $template = get_template_directory().'/'.WC()->template_path().'checkout/yhsshu-form-billing.php';
            break;
        case 'checkout/form-shipping.php':
            $template = get_template_directory().'/'.WC()->template_path().'checkout/yhsshu-form-shipping.php';
            break;
        case 'checkout/review-order.php':
            $template = get_template_directory().'/'.WC()->template_path().'checkout/yhsshu-review-order.php';
            break;
        case 'checkout/thankyou.php':
            $template = get_template_directory().'/'.WC()->template_path().'checkout/yhsshu-thankyou.php';
            break;
    }

    return $template;
}