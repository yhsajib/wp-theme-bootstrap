<?php
defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$product_id          = $product->get_id();
$item_class          = ['grid-item'];
$image_class         = get_post_meta($product->get_id(),'product_layout_style', 'style-df');

?>
<div <?php wc_product_class( $item_class, $product ); ?>>
    <div class="yhsshu-shop-item-wrap">
        <div class="yhsshu-products-thumb relative">
            <div class="image-wrap <?php echo esc_attr($image_class); ?>">
                <?php
                woocommerce_template_loop_product_thumbnail();
                ?>
                <?php if ($image_class == 'style-2'): ?>
                    <div class="yhsshu-clown">
                        <img src="<?php echo esc_url(get_template_directory_uri()) . '/assets/images/pizza-clown.png'; ?>" />
                    </div>
                <?php endif; ?>
            </div>
            <div class="hot-sale">
                <?php
                if ( $product->is_featured() ) {
                    $feature_text = get_post_meta($product->get_id(),'product_feature_text', true);
                    if (empty($feature_text)){
                        $feature_text = "HOT";
                    }
                    ?>
                    <span class="yhsshu-featured"><?php echo esc_html($feature_text); ?></span>
                    <?php
                }
                woocommerce_show_product_loop_sale_flash();
                ?>
            </div>
        </div>
        <div class="yhsshu-products-content">
            <div class="yhsshu-products-content-wrap">
                <div class="yhsshu-products-content-inner">
                    <?php
                    /**
                     * Hook: woocommerce_before_shop_loop_item_title.
                     *
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     */
                    do_action( 'woocommerce_before_shop_loop_item_title' );

                    /**
                     * Hook: woocommerce_shop_loop_item_title.
                     *
                     * @hooked woocommerce_template_loop_product_title - 10
                     */
                    do_action( 'woocommerce_shop_loop_item_title' );
                    ?>
                    <h3 class="yhsshu-product-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <?php
                    /**
                     * Hook: woocommerce_after_shop_loop_item_title.
                     *
                     * @hooked woocommerce_template_loop_rating - 5
                     * @hooked woocommerce_template_loop_price - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item_title' );
                    ?>
                    <?php woocommerce_template_loop_price(); ?>
                    <div class="btn-wrapper">
                        <div class="yhsshu-add-to-cart">
                            <?php woocommerce_template_loop_add_to_cart(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="yhsshu-products-content-list-view d-none">
            <?php woocommerce_template_loop_price(); ?>
            <?php
            /**
             * Hook: woocommerce_before_shop_loop_item_title.
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );

            /**
             * Hook: woocommerce_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );
            ?>
            <h3 class="yhsshu-product-title">
                <a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
            </h3>
            <?php
            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
            <div class="list-view-rating">
                <?php woocommerce_template_loop_rating(); ?>
                <?php
                if(class_exists( 'WPCleverWoosw' )){
                    echo '<div class="yhsshu-shop-woosmart-wrap">';
                    do_action( 'woosw_button_position_archive_woosmart' );
                    echo '</div>';
                }
                ?>
            </div>
            <div class="yhsshu-loop-product-excerpt">
                <?php the_excerpt(); ?>
            </div>
            <?php woocommerce_template_loop_add_to_cart(); ?>
        </div>
    </div>
    <?php
	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
    ?>
</div>