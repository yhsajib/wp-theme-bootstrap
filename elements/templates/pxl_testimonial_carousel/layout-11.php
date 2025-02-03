<?php
$default_settings = [
    'content_list' => [],
];

if(!empty($settings['button_link']['url'])){
    $widget->add_render_attribute( 'link', 'href', $settings['button_link']['url'] );
    if ( $settings['button_link']['is_external'] ) {
        $widget->add_render_attribute( 'link', 'target', '_blank' );
    }
    if ( $settings['button_link']['nofollow'] ) {
        $widget->add_render_attribute( 'link', 'rel', 'nofollow' );
    }
    if ( ! empty( $settings['button_link']['custom_attributes'] ) ) {
        // Custom URL attributes should come as a string of comma-delimited key|value pairs
        $custom_attributes = Utils::parse_custom_attributes( $settings['button_link']['custom_attributes'] );
        $widget->add_render_attribute( 'link', $custom_attributes);
    }
}
$link_attributes = $widget->get_render_attribute_string( 'link' );

$settings = array_merge($default_settings, $settings);
extract($settings);

$show_button = $widget->get_setting('show_button', 'false');
$arrows_style = $widget->get_setting('arrows_style', 'style-1');
$quote_icon_type = $widget->get_setting('quote_icon_type', 'text');

$pagination_style = yhsshu()->get_theme_opt('swiper_pagination_style', 'style-df');

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
    'slides_gutter'                 => 30,
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
    'class'         => 'yhsshu-swiper-container overflow-hidden',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list)): ?>
<div class="yhsshu-swiper-slider yhsshu-testimonial-carousel layout-<?php echo esc_attr($settings['layout'])?>">
    <div class="yhsshu-swiper-slider-wrap yhsshu-carousel-inner relative">
        <div <?php yhsshu_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
            <div class="yhsshu-swiper-wrapper swiper-wrapper">
                <?php foreach ($content_list as $key => $value):
                    $description = isset($value['description']) ? $value['description'] : '';
                    $title       = isset($value['title']) ? $value['title'] : '';
                    $position    = isset($value['position']) ? $value['position'] : '';
                    ?>
                    <div class="yhsshu-swiper-slide swiper-slide">
                        <div class="item-inner">
                            <?php if ($quote_icon_type == 'icon' && !empty($settings['selected_icon']['value'])) { ?>
                                <div class="icon-wrapper">
                                    <?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true', 'class' => 'item-quote-icon yhsshu-icon'], 'i'); ?>
                                </div>
                            <?php } ?>
                            <?php if ($quote_icon_type == 'text') { ?>
                                <div class="item-quote-icon">“</div>
                            <?php } ?>
                            <div class="item-desc"><?php echo yhsshu_print_html($description); ?></div>
                            <div class="item-info d-flex align-items-center justify-content-center">
                                <div class="item-info-wrapper">
                                    <h4 class="item-title"><span><?php echo esc_html($title); ?></span></h4>
                                    <div class="item-position"><?php echo esc_html($position); ?></div>
                                </div>
                                <?php if(!empty($value['rating']) && $value['rating'] != 'none') : ?>
                                    <div class="item-rating-star">
                                        <div class="item-rating <?php echo esc_attr($value['rating']); ?>">
                                            <i class="yhsshui-star1"></i>
                                            <i class="yhsshui-star1"></i>
                                            <i class="yhsshui-star1"></i>
                                            <i class="yhsshui-star1"></i>
                                            <i class="yhsshui-star1"></i>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php yhsshu_arrow_template($settings); ?>
        <div class="yhsshu-swiper-dots"></div>
    </div>
    <?php
    $thumb_opts = [
        'allow_touch_move'              => false,
        'slide_direction'               => 'horizontal',
        'slide_percolumn'               => 1,
        'slide_mode'                    => 'slide', 
        'slides_to_show_xxl'            => 5,
        'slides_to_show'                => 5, 
        'slides_to_show_lg'             => 5, 
        'slides_to_show_md'             => 5, 
        'slides_to_show_sm'             => 5, 
        'slides_to_show_xs'             => 4, 
        'slides_to_scroll'              => 1, 
        'slides_gutter'                 => 20,
        'arrow'                         => false,
        'dots'                          => false,
        'speed'                         => 500,
    ];
    $data_thumb_settings = wp_json_encode($thumb_opts);
    ?>
    <div class="yhsshu-swiper-slider-thumbs d-flex justify-content-center">
        <div class="yhsshu-swiper-slider-inner yhsshu-carousel-inner">
            <div class="yhsshu-swiper-thumbs overflow-hidden" data-settings="<?php echo esc_attr($data_thumb_settings) ?>">
                <div class="yhsshu-thumbs-wrapper swiper-wrapper">
                    <?php
                    $idx = 0;
                    foreach ($content_list as $key => $value):
                        $idx++;
                        $image       = isset($value['image']) ? $value['image'] : [];
                        $thumbnail = '';
                        if(!empty($image['id'])) {
                            $img = yhsshu_get_image_by_size( array(
                                'attach_id'  => $image['id'],
                                'thumb_size' => '250x250',
                                'class' => 'no-lazyload',
                            ));
                            $thumbnail = $img['thumbnail'];
                        }
                        ?>
                        <div class="yhsshu-swiper-slide thumb-item swiper-slide">
                            <div class="thumbs-wrap">
                                <div class="item-wrap">
                                    <?php if(!empty($thumbnail)) :?>
                                        <div class="item-image col-auto">
                                            <span class="img-outer">
                                                <?php echo wp_kses_post($thumbnail); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if ($show_button == 'true') : ?>
                        <a class="btn-circle-more" <?php echo implode( ' ', [ $link_attributes ] ) ?>>...</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>