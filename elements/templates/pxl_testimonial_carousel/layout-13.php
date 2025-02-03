<?php
$default_settings = [
    'content_list' => [],
];

$settings = array_merge($default_settings, $settings);
extract($settings);

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

$widget->add_render_attribute('carousel', [
    'class'         => 'yhsshu-swiper-container overflow-hidden',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
?>
<?php if (isset($content_list) && !empty($content_list) && count($content_list)) : ?>
<div class="yhsshu-swiper-slider yhsshu-testimonial-carousel layout-<?php echo esc_attr($settings['layout']) ?>">
    <div class="yhsshu-swiper-slider-wrap yhsshu-carousel-inner relative d-flex">
        <div <?php yhsshu_print_html($widget->get_render_attribute_string('carousel')); ?>>
            <div class="yhsshu-swiper-wrapper swiper-wrapper">
                <?php foreach ($content_list as $key => $value) :
                    $image       = isset($value['image']) ? $value['image'] : [];
                    $title       = isset($value['title']) ? $value['title'] : '';
                    $position    = isset($value['position']) ? $value['position'] : '';
                    $testimonial_title = isset($value['testimonial_title']) ? $value['testimonial_title'] : '';
                    $description = isset($value['description']) ? $value['description'] : '';
                    if (!empty($image['id'])) {
                        $img = yhsshu_get_image_by_size(array(
                            'attach_id'  => $image['id'],
                            'thumb_size' => '69x69',
                            'class' => 'no-lazyload',
                        ));
                        $thumbnail = $img['thumbnail'];
                    }
                    ?>
                    <div class="yhsshu-swiper-slide swiper-slide">
                        <div class="item-inner d-flex">
                            <div class="item-content">
                                <?php if (!empty($description)) : ?>
                                    <div class="item-desc"><?php echo yhsshu_print_html($description); ?></div>
                                <?php endif; ?>
                                <div class="content-wrapper">
                                    <?php if (!empty($thumbnail)) : ?>
                                        <div class="item-image col-auto">
                                            <span class="img-outer">
                                                <?php echo wp_kses_post($thumbnail); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="box-title-pos">
                                        <?php if (!empty($title)) : ?>
                                            <h4 class="item-title"><span><?php echo esc_html($title); ?></span></h4>
                                        <?php endif; ?>
                                        <?php if (!empty($position)) : ?>
                                            <div class="item-position"><?php echo esc_html($position); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
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