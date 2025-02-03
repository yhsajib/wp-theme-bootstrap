<?php
use Elementor\Icons_Manager;
Icons_Manager::enqueue_shim();
$default_settings = [
    'content_list' => [],
];
$settings = array_merge($default_settings, $settings);
extract($settings);

$img_size = !empty( $img_size ) ? $img_size : '610x610'; 

$show_icon = $widget->get_setting('show_icon','false');  
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
    'center_slide'                  => (bool)$widget->get_setting('center_slide', false),
    'slides_gutter'                 => (int)$widget->get_setting('space_between', 30), 
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
<?php if(isset($content_list) && !empty($content_list) && count($content_list)): ?>
    <div class="yhsshu-swiper-slider yhsshu-team yhsshu-team-carousel layout-<?php echo esc_attr($settings['layout'])?> center-mode-<?php echo esc_attr($opts['center_slide']); ?>">
        <div class="yhsshu-swiper-slider-wrap yhsshu-carousel-inner relative">
            <div <?php yhsshu_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="yhsshu-swiper-wrapper swiper-wrapper">
                    <?php foreach ($content_list as $key => $value):
                        $title    = isset($value['title']) ? $value['title'] : '';
                        $position = isset($value['position']) ? $value['position'] : '';
                        $description = isset($value['description']) ? $value['description'] : '';
                        $button_Text = isset($value['button_Text']) ? $value['button_Text'] : '';
                        $image    = isset($value['image']) ? $value['image'] : [];
                        $link     = isset($value['link']) ? $value['link'] : '';
                        $thumbnail = '';
                        if (!empty($image) && is_array($image) && isset($image['id'])) {
                            $img = yhsshu_get_image_by_size(array(
                                'attach_id'  => $image['id'],
                                'thumb_size' => $img_size,
                                'class'      => 'no-lazyload',
                            ));
                            if (is_array($img) && isset($img['thumbnail'])) {
                                $thumbnail = $img['thumbnail'];
                            }
                        }
                        $link_key = $widget->get_repeater_setting_key( 'link', 'content_list', $key );
                        if ( ! empty( $link['url'] ) ) {
                            $widget->add_render_attribute( $link_key, 'href', $link['url'] );

                            if ( $link['is_external'] ) {
                                $widget->add_render_attribute( $link_key, 'target', '_blank' );
                            }

                            if ( $link['nofollow'] ) {
                                $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                            }
                            if ( ! empty( $link['custom_attributes'] ) ) {
                                // Custom URL attributes should come as a string of comma-delimited key|value pairs
                                $custom_attributes = Utils::parse_custom_attributes( $link['custom_attributes'] );
                                $widget->add_render_attribute( $link_key, $custom_attributes);
                            }
                        }
                        $link_attributes = $widget->get_render_attribute_string( $link_key );
                        ?>
                        <div class="yhsshu-swiper-slide swiper-slide">
                            <div class="item-inner">
                                <?php if(!empty($thumbnail)) { ?>
                                    <div class="item-image">
                                        <div class="image-wrap">
                                                <?php echo wp_kses_post($thumbnail); ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="item-content">
                                    <?php if ($show_icon !== 'false') :
                                        ?>
                                        <div class="box-icon">
                                            <i class="yhsshui yhsshui-chinese-lantern"></i>
                                        </div>
                                        <?php
                                     endif; ?>
                                    <h3 class="item-title">
                                        <?php echo yhsshu_print_html($title); ?>
                                    </h3>
                                    <div class="item-position"><?php echo yhsshu_print_html($position); ?></div>
                                    <?php if(!empty($description)) { ?>
                                        <div class="item-description"><?php echo yhsshu_print_html($description); ?></div>
                                    <?php } ?>
                                    <?php if(!empty($button_Text)) { ?>
                                            <div class="btn-text">
                                            <?php if ( ! empty( $link['url'] ) ): ?><a class="btn-more" <?php echo implode( ' ', [ $link_attributes ] ); ?>><?php endif; ?>
                                                <?php echo esc_html($button_Text); ?>
                                            <?php if ( ! empty( $link['url'] ) ): ?></a><?php endif; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>    
            </div>
            <?php yhsshu_arrow_template($settings, 'yhsshui yhsshui-arrow-draw', 'yhsshui yhsshui-arrow-draw'); ?>
            <div class="yhsshu-swiper-dots"></div>
        </div>
    </div>
<?php endif; ?>