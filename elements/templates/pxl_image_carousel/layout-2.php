<?php
extract($settings);

$imgGallery = $settings['img_gallery'];
$arrows_style = $widget->get_setting('arrows_style', 'style-1');

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_mode'                    => 'slide', 
    'slides_to_show_xxl'            => (float)$widget->get_setting('col_xxl', 3),
    'slides_to_show'                => (float)$widget->get_setting('col_xl', 3),
    'slides_to_show_lg'             => (float)$widget->get_setting('col_lg', 2),
    'slides_to_show_md'             => (float)$widget->get_setting('col_md', 2),
    'slides_to_show_sm'             => (float)$widget->get_setting('col_sm', 1),
    'slides_to_show_xs'             => (float)$widget->get_setting('col_xs', 1), 
    'slides_to_scroll'              => (int)$widget->get_setting('slides_to_scroll', 1), 
    'slides_gutter'                 => $space_between,
    'arrow'                         => true,
    'dots'                          => true,
    'dots_style'                    => 'bullets',
    'autoplay'                      => (bool)$widget->get_setting('autoplay', false),
    'pause_on_hover'                => (bool)$widget->get_setting('pause_on_hover', false),
    'pause_on_interaction'          => true,
    'delay'                         => (int)$widget->get_setting('autoplay_speed', 5000),
    'loop'                          => (bool)$widget->get_setting('infinite', false),
    'speed'                         => (int)$widget->get_setting('speed', 500),
    'setting_drag'                  => $drag,
];

$widget->add_render_attribute( 'carousel', [
    'class'         => 'yhsshu-swiper-container overflow-hidden',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);

$img_size = !empty($img_size) ? $img_size : 'full';
$button_text = !empty($button_text) ? $button_text : esc_html__('Drag', 'yhsshu');
?>

<div class="yhsshu-swiper-slider yhsshu-image-carousel layout-2">
    <div class="yhsshu-swiper-slider-wrap yhsshu-carousel-inner relative">
        <div <?php yhsshu_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
            <div class="yhsshu-swiper-wrapper swiper-wrapper">
                <?php foreach ($imgGallery as $key => $value) :
                    $image = isset($value['id']) ? $value['id'] : '';
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $image,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                    ?>
                    <div class="yhsshu-swiper-slide swiper-slide">
                        <div class="inner-box">
                            <?php if (!empty($image)) : ?>
                                <div class="item-inner">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </div>
                                <?php if(!empty($widget->get_setting('title_image'))) { ?>
                                    <h3 class="item-title">
                                        <?php echo yhsshu_print_html($widget->get_setting('title_image')); ?>
                                    </h3>
                                <?php } ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php yhsshu_arrow_template($settings); ?>
        <div class="yhsshu-swiper-dots"></div>
    </div>
</div>