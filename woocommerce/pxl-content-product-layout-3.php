<?php
defined( 'ABSPATH' ) || exit;

global $product;
// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>
<div <?php wc_product_class( '', $product ); ?>>
    <div class="yhsshu-shop-item-wrap">
        <div class="yhsshu-products-thumb relative">
            <div class="image-wrap">
                <?php
                woocommerce_template_loop_product_thumbnail();
                ?>
            </div>
            <div class="hot-sale">
                <?php
                if ( $product->is_featured() ) {
                    $feature_text = get_post_meta($product->get_id(),'product_feature_text', true);
                    $feature_text_02 = get_post_meta($product->get_id(),'product_feature_text_02', true);
                    if (empty($feature_text)){
                        $feature_text = "HOT";
                    }
                    if (!empty(get_post_meta($product->get_id(), 'feature_color_01', ''))) {
                        $feature_color_01_from = get_post_meta($product->get_id(), 'feature_color_01', ['from' => '#673AB7'])['from'];
                        $feature_color_01_to = get_post_meta($product->get_id(),'feature_color_01', ['to' => '#973BF5'])['to'];
                        $feature_color_01_angle = get_post_meta($product->get_id(), 'feature_color_01', ['gradient-angle' => '180'])['gradient-angle'].'deg';
                        $style_text = 'background-image: linear-gradient(%s, %s 0%%, %s 100%%);';
                        $feature_color_01_style = sprintf($style_text, $feature_color_01_angle, $feature_color_01_from, $feature_color_01_to);
                    }
                    else {
                        $feature_color_01_style = "";
                    }
                    ?>
                    <span class="yhsshu-featured" <?php echo 'style="'.esc_html($feature_color_01_style).'"' ?>><?php echo esc_html($feature_text); ?></span>

                    <?php 
                    if (!empty($feature_text_02)) {
                        if (!empty(get_post_meta($product->get_id(), 'feature_color_02', ''))) {
                            $feature_color_02_from = get_post_meta($product->get_id(), 'feature_color_02', ['from' => '#a90001'])['from'];
                            $feature_color_02_to = get_post_meta($product->get_id(),'feature_color_02', ['to' => '#ed2b2c'])['to'];
                            $feature_color_02_angle = get_post_meta($product->get_id(), 'feature_color_02', ['gradient-angle' => '0'])['gradient-angle'].'deg';
                            $style_text_02 = 'background-image: linear-gradient(%s, %s 0%%, %s 100%%);';
                            $feature_color_02_style = sprintf($style_text, $feature_color_02_angle, $feature_color_02_from, $feature_color_02_to);
                        }
                        else {
                            $feature_color_02_style = "";
                        }
                        ?>
                        <span class="yhsshu-featured" <?php echo 'style="'.esc_html($feature_color_02_style).'"' ?>><?php echo esc_html($feature_text_02); ?></span>
                        <?php
                    }
                }
                woocommerce_show_product_loop_sale_flash();
                ?>
            </div>
            <div class="cal-price-wrap d-flex">
                <?php
                $additional_text = get_post_meta($product->get_id(), 'product_loop_additional_text1', '');
                if (!empty($additional_text)) : ?>
                    <div class="d-inline-flex">
                        <?php echo esc_html($additional_text[0]); ?>
                    </div>
                <?php endif; ?>
                <?php woocommerce_template_loop_price(); ?>
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
                    <div class="yhsshu-divider"></div>
                    <div class="yhsshu-loop-product-excerpt">
                        <?php
                        $excerpt = get_the_excerpt();
                        if (!empty($excerpt)) {
                            echo wp_trim_words($excerpt, 17, '...');
                        }
                        ?>
                    </div>
                    <div class="btn-wrapper">
                        <div class="yhsshu-add-to-cart">
                            <div class="wrap-btn for-cart">
                                <?php woocommerce_template_loop_add_to_cart(); ?>
                            </div>
                        </div>
                        <?php
                        $product_wishlist = yhsshu()->get_theme_opt('product_wishlist', '0');
                        if ($product_wishlist == '1') : ?>
                            <div class="stock-wishlist">
                                <div class="yhsshu-shop-woosmart-wrap">
                                    <?php do_action( 'woosw_button_position_single_woosmart' ); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
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