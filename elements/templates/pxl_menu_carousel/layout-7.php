<?php
$default_settings = [
    'list_food_2' => [],
];
   
$settings = array_merge($default_settings, $settings);
extract($settings);

$arrows_style = $widget->get_setting('arrows_style', 'style-1');

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_mode'                    => 'slide', 
    'slides_to_show_xxl'            => (int)$widget->get_setting('col_xxl', 3),
    'slides_to_show'                => (int)$widget->get_setting('col_xl', 3),
    'slides_to_show_lg'             => (int)$widget->get_setting('col_lg', 2),
    'slides_to_show_md'             => (int)$widget->get_setting('col_md', 2),
    'slides_to_show_sm'             => (int)$widget->get_setting('col_sm', 1),
    'slides_to_show_xs'             => (int)$widget->get_setting('col_xs', 1), 
    'slides_to_scroll'              => (int)$widget->get_setting('slides_to_scroll', 1), 
    'slides_gutter'                 => 40,
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
  
$img_size = !empty($img_size) ? $img_size : '284x210';
$widget->add_render_attribute( 'carousel', [
    'class'         => 'yhsshu-swiper-container overflow-hidden',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
?>
<?php if(isset($list_food_2) && !empty($list_food_2) && count($list_food_2)): ?>
    <div class="yhsshu-swiper-slider yhsshu-menu-carousel layout-<?php echo esc_attr($settings['layout'])?>">
        <div class="yhsshu-swiper-slider-wrap yhsshu-carousel-inner relative">
            <div <?php yhsshu_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="yhsshu-swiper-wrapper swiper-wrapper">
                <?php foreach ($list_food_2 as $key => $value) :
                ?>
                    <div class="yhsshu-swiper-slide swiper-slide elementor-repeater-item-<?php echo esc_attr($value['_id']); ?>">
                        <div class="item-inner">
                            <?php if (!empty( $value['selected_img_2']['id'])) :
                                $thumbnail = '';
                                $img  = yhsshu_get_image_by_size(array(
                                    'attach_id'  => $value['selected_img_2']['id'],
                                    'thumb_size' => $img_size,
                                    'class' => 'no-lazyload',
                                ));
                                $thumbnail = $img['thumbnail'];
                                ?>
                                <div class="item-featured">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </div>
                            <?php endif; ?>
                            <div class="item-content">
                                <?php if (!empty($value['title_food_2'])) : ?>
                                    <div class="menu-title">
                                        <span>
                                            <?php echo yhsshu_print_html($value['title_food_2']); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($value['description_food_2'])) : ?>
                                    <div class="menu-description">
                                        <?php echo esc_html($value['description_food_2']); ?>
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