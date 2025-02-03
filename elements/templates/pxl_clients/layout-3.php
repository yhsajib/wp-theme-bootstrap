<?php
$default_settings = [
    'clients' => [],
];
$settings = array_merge($default_settings, $settings);
extract($settings);  

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_mode'                    => 'slide', 
    'slides_to_show_xxl'            => (int)$widget->get_setting('col_xxl', 4), 
    'slides_to_show'                => (int)$widget->get_setting('col_xl', 4), 
    'slides_to_show_lg'             => (int)$widget->get_setting('col_lg', 3), 
    'slides_to_show_md'             => (int)$widget->get_setting('col_md', 3), 
    'slides_to_show_sm'             => (int)$widget->get_setting('col_sm', 2), 
    'slides_to_show_xs'             => (int)$widget->get_setting('col_xs', 1), 
    'slides_to_scroll'              => (int)$widget->get_setting('slides_to_scroll', 1), 
    'slides_gutter'                 => 50, 
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

<?php if(isset($clients) && !empty($clients) && count($clients)): ?>
    <div class="yhsshu-swiper-slider yhsshu-clients layout-<?php echo esc_attr($settings['layout'])?>">
        <div class="yhsshu-swiper-slider-wrap yhsshu-carousel-inner relative">
            <div <?php yhsshu_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="yhsshu-swiper-wrapper swiper-wrapper align-items-center">
                    <?php foreach ($clients as $key => $value):
                        $client_img       = isset($value['client_img']) ? $value['client_img'] : [];
                        $name             = isset($value['name']) ? $value['name'] : '';
                        $image_link       = isset($value['image_link']) ? $value['image_link'] : [];
                         
                        $thumbnail1 = '';
                        if(!empty($client_img['id'])) {
                            $img = yhsshu_get_image_by_size( array(
                                'attach_id'  => $client_img['id'],
                                'thumb_size' => 'full',
                                'class' => 'no-lazyload',
                            ));
                            $thumbnail1 = $img['thumbnail'];
                        }  

                        $link_key = $widget->get_repeater_setting_key( 'image_link', 'clients', $key ); 
                        if ( ! empty( $image_link['url'] ) ) {
                            $widget->add_render_attribute( $link_key, 'href', $image_link['url'] );

                            if ( $image_link['is_external'] ) {
                                $widget->add_render_attribute( $link_key, 'target', '_blank' );
                            }

                            if ( $image_link['nofollow'] ) {
                                $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                            }

                            if( ! empty($image_link['custom_attributes'])){
                                $custom_attributes = explode('|', $image_link['custom_attributes']);
                                foreach ($custom_attributes as $atts_value) {
                                    $_custom_attributes = explode(':', $atts_value);
                                    $widget->add_render_attribute( $link_key, $_custom_attributes[0], $_custom_attributes[1] );
                                }

                            }
                        }
                        $link_attributes = $widget->get_render_attribute_string( $link_key );
 
                        ?>
                        <div class="yhsshu-swiper-slide swiper-slide">
                            <div class="item-inner relative">
                                <div class="item-image-wrap">
                                    <?php if(!empty($thumbnail1)) : ?>
                                        <div class="item-image">
                                            <?php if ( ! empty( $image_link['url'] ) ) echo '<a '. $link_attributes .'>';
                                                echo wp_kses_post($thumbnail1);  
                                            if ( ! empty( $image_link['url'] ) ) echo '</a>';
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="item-content d-none">
                                    <h4 class="item-name"><?php echo esc_html($name); ?></h4>
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
  