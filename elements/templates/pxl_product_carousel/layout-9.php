<?php
if (!class_exists('Woocommerce')){
    ?> <h4> <?php echo esc_html__('Please Install Woocommerce!', 'yhsshu'); ?></h4><?php
    return true;
}
extract($settings);
$query_type = $widget->get_setting('query_type', 'recent_product');
$post_per_page = $widget->get_setting('post_per_page', 8);
$product_ids = $widget->get_setting('product_ids', '');
$categories = $widget->get_setting('taxonomies', '');
$param_args=[];
$posts = yhsshu_Woo_Query::instance()->yhsshu_woocommerce_query($query_type,$post_per_page,$product_ids,$categories,$param_args);
extract($posts);

$arrows_style = $widget->get_setting('arrows_style', 'style-1');

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1,
    'slide_mode'                    => 'slide',
    'slides_to_show_xxl'            => (float)$widget->get_setting('col_xxl', 4),
    'slides_to_show'                => (float)$widget->get_setting('col_xl', 4),
    'slides_to_show_lg'             => (float)$widget->get_setting('col_lg', 3),
    'slides_to_show_md'             => (float)$widget->get_setting('col_md', 3),
    'slides_to_show_sm'             => (float)$widget->get_setting('col_sm', 2),
    'slides_to_show_xs'             => (float)$widget->get_setting('col_xs', 1),
    'slides_to_scroll'              => (int)$widget->get_setting('slides_to_scroll', 1),
    'slides_gutter'                 => (int)$gutter,
    'center_slide'                  => (bool)$widget->get_setting('center_slide', false),
    'arrow'                         => true,
    'dots'                          => true,
    'dots_style'                    => 'bullets',
    'autoplay'                      => (bool)$widget->get_setting('autoplay', false),
    'pause_on_hover'                => (bool)$widget->get_setting('pause_on_hover', false),
    'pause_on_interaction'          => true,
    'delay'                         => (int)$widget->get_setting('autoplay_speed', 5000),
    'loop'                          => (bool)$widget->get_setting('infinite', false),
    'speed'                         => (int)$widget->get_setting('speed', 500)
];

$widget->add_render_attribute( 'carousel', [
    'class'         => 'yhsshu-swiper-container products',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
$img_size = !empty( $img_size ) ? $img_size : '486x600';
if ( ! empty( $settings['loadmore_link']['url'] ) ) {
    $widget->add_render_attribute( 'loadmore', 'href', $settings['loadmore_link']['url'] );
    if ( $settings['loadmore_link']['is_external'] ) {
        $widget->add_render_attribute( 'loadmore', 'target', '_blank' );
    }
    if ( $settings['loadmore_link']['nofollow'] ) {
        $widget->add_render_attribute( 'loadmore', 'rel', 'nofollow' );
    }
    $loadmore_text = !empty( $loadmore_text ) ? $loadmore_text : esc_html__( 'Load More', 'yhsshu' );
    $widget->add_render_attribute( 'loadmore', 'class', 'btn');
}

$data_settings = $item_anm_cls = '';
if ( !empty( $item_animation) ) {

    $item_anm_cls= ' yhsshu-animate yhsshu-invisible animated-'.$item_animation_duration;
    $item_animation_delay = !empty($item_animation_delay) ? $item_animation_delay : '150';
    $data_animations = [
        'animation' => $item_animation,
        'animation_delay' => (float)$item_animation_delay
    ];
}
?>
<?php if(!empty($posts) && count($posts)): ?>
<div class="yhsshu-swiper-slider yhsshu-product-carousel yhsshu-shop-layout-9">
    <div class="yhsshu-swiper-slider-wrap yhsshu-carousel-inner relative">
        <div <?php yhsshu_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
            <div class="yhsshu-swiper-wrapper swiper-wrapper">
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    echo '<div class="yhsshu-swiper-slide swiper-slide">';
                    wc_get_template( 'yhsshu-content-product-layout-9.php' );
                    echo '</div>';
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php yhsshu_arrow_template($settings, 'yhsshui yhsshui-arrow-left', 'yhsshui yhsshui-arrow-right'); ?>
        <div class="yhsshu-swiper-dots"></div>
    </div>
</div>
<?php endif; ?>