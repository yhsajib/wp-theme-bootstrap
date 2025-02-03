<?php
$default_settings = [
    'boxs' => [],
];

$settings = array_merge($default_settings, $settings);
extract($settings);

$arrows_style = $widget->get_setting('arrows_style', 'style-1');

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_mode'                    => 'slide', 
    'slides_to_show_xxl'            => (float)$widget->get_setting('col_xxl', 1),
    'slides_to_show'                => (float)$widget->get_setting('col_xl', 1),
    'slides_to_show_lg'             => (float)$widget->get_setting('col_lg', 1),
    'slides_to_show_md'             => (float)$widget->get_setting('col_md', 1),
    'slides_to_show_sm'             => (float)$widget->get_setting('col_sm', 1),
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


$widget->add_render_attribute( 'carousel', [
    'class'         => 'yhsshu-swiper-container overflow-hidden',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
?>
<?php if(isset($boxs) && !empty($boxs) && count($boxs)): ?>
<div class="yhsshu-swiper-slider yhsshu-fancy-box-carousel layout-<?php echo esc_attr($settings['layout'])?>">
    <div class="yhsshu-swiper-slider-wrap yhsshu-carousel-inner relative">
        <div <?php yhsshu_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
            <div class="yhsshu-swiper-wrapper swiper-wrapper">
                <?php foreach ($boxs as $box): ?>
                    <div class="yhsshu-swiper-slide swiper-slide">
                        <div class="item-inner">
                            <?php
                            if(!empty( $box['selected_img']['id'])){
                                $thumbnail = '';
                                $img  = yhsshu_get_image_by_size( array(
                                    'attach_id'  => $box['selected_img']['id'],
                                    'thumb_size' => 'full',
                                ) );
                                $thumbnail = $img['thumbnail'];
                                ?>
                                <div class="item-image">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="item-content">
                                <div class="content-inner">
                                    <?php
                                    if (!empty($box['title_text'])){
                                        ?>
                                        <h3 class="item-title">
                                            <span><?php echo yhsshu_print_html($box['title_text']); ?></span>
                                        </h3>
                                        <?php
                                    }
                                    if (!empty($box['sub_title_text'])){
                                        ?>
                                        <span class="item-sub-title">
                                            <?php echo yhsshu_print_html($box['sub_title_text']); ?>
                                        </span>
                                        <?php
                                    }
                                    if (!empty($box['description_text'])){
                                        ?>
                                        <div class="item-description">
                                            <?php echo yhsshu_print_html($box['description_text']); ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="item-title-wrap">
                                <?php
                                if (!empty($box['title_text'])){
                                    ?>
                                    <h3 class="item-title">
                                        <span><?php echo yhsshu_print_html($box['title_text']); ?></span>
                                    </h3>
                                    <?php
                                }
                                if (!empty($box['sub_title_text'])){
                                    ?>
                                    <span class="item-sub-title">
                                        <?php echo yhsshu_print_html($box['sub_title_text']); ?>
                                    </span>
                                    <?php
                                }
                                ?>
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
