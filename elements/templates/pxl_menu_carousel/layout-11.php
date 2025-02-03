<?php
$default_settings = [
    'list' => [],
];
   
$settings = array_merge($default_settings, $settings);
extract($settings);

$arrows = $widget->get_setting('arrows','false');
$arrows_style = $widget->get_setting('arrows_style', 'style-1');
$dots = $widget->get_setting('dots','false');  

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => '1', 
    'slide_mode'                    => 'slide', 
    'slides_to_show_xxl'            => $widget->get_setting('col_xxl', '3'),
    'slides_to_show'                => $widget->get_setting('col_xl', '3'),
    'slides_to_show_lg'             => $widget->get_setting('col_lg', '2'),
    'slides_to_show_md'             => $widget->get_setting('col_md', '2'),
    'slides_to_show_sm'             => $widget->get_setting('col_sm', '1'),
    'slides_to_show_xs'             => $widget->get_setting('col_xs', '1'), 
    'slides_to_scroll'              => $widget->get_setting('slides_to_scroll', '1'), 
    'slides_gutter'                 => 30,
    'arrow'                         => true,
    'dots'                          => true,
    'dots_style'                    => 'bullets',
    'autoplay'                      => $widget->get_setting('autoplay', false),
    'pause_on_hover'                => $widget->get_setting('pause_on_hover', 'true'),
    'pause_on_interaction'          => 'true',
    'delay'                         => $widget->get_setting('autoplay_speed', '5000'),
    'loop'                          => $widget->get_setting('infinite','false'),
    'speed'                         => $widget->get_setting('speed', '500')
];
  
$img_size = !empty($img_size) ? $img_size : '370x467';
$widget->add_render_attribute( 'carousel', [
    'class'         => 'yhsshu-swiper-container overflow-hidden',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
?>
<?php if(isset($list) && !empty($list) && count($list)): ?>
    <div class="yhsshu-swiper-slider yhsshu-menu-carousel layout-<?php echo esc_attr($settings['layout'])?>">
        <div class="yhsshu-swiper-slider-wrap yhsshu-carousel-inner relative">
            <div <?php yhsshu_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="yhsshu-swiper-wrapper swiper-wrapper">
                <?php foreach ($list as $key => $value) :
                    $link = isset($value['link']) ? $value['link'] : '';
                    $link_key = $widget->get_repeater_setting_key( 'content', 'value', $key );
                    if ( ! empty( $link['url'] ) ) {
                        $widget->add_render_attribute( $link_key, 'href', $link['url'] );

                        if ( $link['is_external'] ) {
                            $widget->add_render_attribute( $link_key, 'target', '_blank' );
                        }

                        if ( $link['nofollow'] ) {
                            $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        }
                    }
                    $link_attributes = $widget->get_render_attribute_string( $link_key );
                ?>
                    <div class="yhsshu-swiper-slide swiper-slide">
                        <div class="item-inner">
                            <?php if (!empty( $value['selected_img']['id'])) :
                                $thumbnail = '';
                                $img  = yhsshu_get_image_by_size(array(
                                    'attach_id'  => $value['selected_img']['id'],
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
                                <?php
                                if (!empty( $value['price'] )) : ?>
                                    <div class="menu-price">
                                        <?php echo yhsshu_print_html($value['price']); ?>
                                    </div>
                                <?php endif;
                                if (!empty($value['title'])) : ?>
                                    <div class="menu-title">
                                        <?php if (!empty( $value['link']['url'])) : ?>
                                            <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                            <?php endif; ?>
                                            <span>
                                                <?php echo yhsshu_print_html($value['title']); ?>
                                            </span>
                                            <?php if (!empty( $value['link']['url'])) : ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif;
                                if (!empty($value['description'])) : ?>
                                    <div class="menu-description">
                                        <?php echo esc_html($value['description']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
            <?php if ($arrows !== 'false') :
                yhsshu_arrow_template($settings);
            endif; ?>
            <?php if($dots !== 'false') : ?>
                <div class="yhsshu-swiper-dots"></div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>