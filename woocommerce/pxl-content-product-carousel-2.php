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
            <?php
            $img = array();
            $image_size = !empty($img_size) ? $img_size : '768x677';
            $img_id       = get_post_thumbnail_id( get_the_ID() );
            if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), false)){
                $img          = yhsshu_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $image_size
                ) );
            }
            $thumbnail    = $img['thumbnail'];
            $demo_image = get_post_meta(get_the_ID(), 'demo_image',true);
            if (!empty($demo_image['url']) ){
                ?>
                <div class="image-wrap">
                    <img class="demo-image" src="<?php echo esc_url($demo_image['url']); ?>" alt="<?php echo esc_attr__('Demo Image', 'yhsshu');?>">
                </div>
                <?php
            }else{
                ?>
                <div class="image-wrap">
                    <?php echo wp_kses_post($thumbnail); ?>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="yhsshu-products-content">
            <div class="yhsshu-products-content-wrap">
                <div class="yhsshu-products-content-inner">
                    <div class="top-content-inner d-md-flex gx-30 justify-content-center">
                        <?php woocommerce_template_loop_price(); ?>
                    </div>
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
                    <div class="yhsshu-loop-product-excerpt">
                        <?php
                        $excerpt = get_the_excerpt();
                        if (!empty($excerpt)) {
                            echo wp_trim_words($excerpt, 17, '.');
                        }
                        ?>
                    </div>
                    <?php woocommerce_template_loop_rating(); ?>
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