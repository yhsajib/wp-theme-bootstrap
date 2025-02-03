<?php
$default_settings = [
    'content_list' => [],
];

$settings = array_merge($default_settings, $settings);
extract($settings);

$arrows_style = $widget->get_setting('arrows_style', 'style-1');
$quote_icon_type = $widget->get_setting('quote_icon_type', 'text');

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1,
    'slide_mode'                    => 'slide',
    'slides_to_show_xxl'            => (float)$widget->get_setting('col_xxl', 4), 
    'slides_to_show'                => (float)$widget->get_setting('col_xl', 4),
    'slides_to_show_lg'             => (float)$widget->get_setting('col_lg', 4),
    'slides_to_show_md'             => (float)$widget->get_setting('col_md', 4),
    'slides_to_show_sm'             => (float)$widget->get_setting('col_sm', 4),
    'slides_to_show_xs'             => (float)$widget->get_setting('col_xs', 1),
    'slides_to_scroll'              => (int)$widget->get_setting('slides_to_scroll', 1), 
    'slides_gutter'                 => 30,
    'arrow'                         => true,
    'dots'                          => true,
    'dots_style'                    => 'bullets',
    'autoplay'                      => (bool)$widget->get_setting('autoplay', false),
    'pause_on_hover'                => (bool)$widget->get_setting('pause_on_hover', true),
    'pause_on_interaction'          => true,
    'delay'                         => (int)$widget->get_setting('autoplay_speed', 5000),
    'loop'                          => (bool)$widget->get_setting('infinite', false),
    'speed'                         => (int)$widget->get_setting('speed', 500)
];


$widget->add_render_attribute('carousel', [
    'class'         => 'yhsshu-swiper-container overflow-hidden',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
?>
<?php if (isset($content_list) && !empty($content_list) && count($content_list)) : ?>
<div class="yhsshu-swiper-slider yhsshu-testimonial-carousel layout-<?php echo esc_attr($settings['layout']) ?>">
    <div class="yhsshu-swiper-slider-wrap yhsshu-carousel-inner relative">
        <div <?php yhsshu_print_html($widget->get_render_attribute_string('carousel')); ?>>
            <div class="yhsshu-swiper-wrapper swiper-wrapper">
                <?php foreach ($content_list as $key => $value) :
                    $image       = isset($value['image']) ? $value['image'] : [];
                    $title       = isset($value['title']) ? $value['title'] : '';
                    $position    = isset($value['position']) ? $value['position'] : '';
                    $testimonial_title = isset($value['testimonial_title']) ? $value['testimonial_title'] : '';
                    $description = isset($value['description']) ? $value['description'] : '';
                    $thumbnail = '';
                    if (!empty($image['id'])) {
                        $img = yhsshu_get_image_by_size(array(
                            'attach_id'  => $image['id'],
                            'thumb_size' => '250x250',
                            'class' => 'no-lazyload',
                        ));
                        $thumbnail = $img['thumbnail'];
                    }
                    ?>
                    <div class="yhsshu-swiper-slide swiper-slide">
                        <div class="item-inner relative">
                            <?php if ($quote_icon_type == 'icon' && !empty($settings['selected_icon']['value'])) { ?>
                                <div class="icon-wrapper">
                                    <?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true', 'class' => 'item-quote-icon yhsshu-icon'], 'i'); ?>
                                </div>
                            <?php } ?>
                            <?php if ($quote_icon_type == 'text') { ?>
                                <div class="item-quote-icon">“</div>
                            <?php } ?>
                            <?php if (!empty($testimonial_title)) { ?>
                                <h4 class="testimonial-title"><?php echo esc_html($testimonial_title); ?></h4>
                            <?php } ?>
                            <div class="item-desc"><?php echo yhsshu_print_html($description); ?></div>
                            <div class="item-wrap">
                                <div class="item-info">
                                    <h4 class="item-title"><?php echo esc_html($title); ?></h4>
                                    <div class="item-position"><?php echo esc_html($position); ?></div>
                                    <?php if (!empty($thumbnail)) : ?>
                                        <div class="item-image col-auto">
                                            <span class="img-outer">
                                                <?php echo wp_kses_post($thumbnail); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($value['rating']) && $value['rating'] != 'none') : ?>
                                    <div class="item-rating-star">
                                        <div class="item-rating <?php echo esc_attr($value['rating']); ?>">
                                            <i class="zmdi zmdi-star"></i>
                                            <i class="zmdi zmdi-star"></i>
                                            <i class="zmdi zmdi-star"></i>
                                            <i class="zmdi zmdi-star"></i>
                                            <i class="zmdi zmdi-star"></i>
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
</div>
<?php endif; ?>