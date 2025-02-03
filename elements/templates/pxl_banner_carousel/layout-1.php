<?php
use Elementor\Utils;
$default_settings = [
    'banners' => [],
];
   
$settings = array_merge($default_settings, $settings);
extract($settings);
$arrows_style = $widget->get_setting('arrows_style', 'style-1');
$arrows = $widget->get_setting('arrows','false');
$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => '1', 
    'slide_mode'                    => 'slider', 
    'slides_to_show_xxl'            => $widget->get_setting('col_xxl', '1'),
    'slides_to_show'                => $widget->get_setting('col_xl', '1'),
    'slides_to_show_lg'             => $widget->get_setting('col_lg', '1'),
    'slides_to_show_md'             => $widget->get_setting('col_md', '1'),
    'slides_to_show_sm'             => $widget->get_setting('col_sm', '1'),
    'slides_to_show_xs'             => $widget->get_setting('col_xs', '1'), 
    'slides_to_scroll'              => $widget->get_setting('slides_to_scroll', '1'), 
    'slides_gutter'                 => 0,
    'arrow'                         => $arrows,
    'loop'                          => $widget->get_setting('infinite',false),
    'speed'                         => $widget->get_setting('speed', '500')
];
  

$widget->add_render_attribute( 'carousel', [
    'class'         => 'yhsshu-swiper-container overflow-hidden',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
?>
<?php if(isset($banners) && !empty($banners) && count($banners)): ?>
    <div class="yhsshu-swiper-slider yhsshu-banner-carousel layout-<?php echo esc_attr($settings['layout'])?>">
        <div class="yhsshu-swiper-slider-wrap yhsshu-carousel-inner relative">
            <div <?php yhsshu_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="yhsshu-swiper-wrapper swiper-wrapper">
                <?php foreach ($banners as $index => $item):
                    // Link Repeater Key
                    $link_key = $widget->get_repeater_setting_key( 'link', 'banners', $index );
                    if ( ! empty( $item['link']['url'] ) ) {
                        $widget->add_render_attribute( $link_key, 'href', $item['link']['url'] );
                        if ( $item['link']['is_external'] ) {
                            $widget->add_render_attribute( $link_key, 'target', '_blank' );
                        }
                        if ( $item['link']['nofollow'] ) {
                            $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        }
                        if ( ! empty( $settings['link']['custom_attributes'] ) ) {
                            // Custom URL attributes should come as a string of comma-delimited key|value pairs
                            $custom_attributes = Utils::parse_custom_attributes( $settings['link']['custom_attributes'] );
                            $widget->add_render_attribute( 'link', $custom_attributes);
                        }
                    }
                    $link_attributes = $widget->get_render_attribute_string( $link_key );
                    // Item Repeater Key
                    $item_key = $widget->get_repeater_setting_key( 'title_text', 'banners', $index );
                    $widget->add_render_attribute( $item_key, 'class', [
                        'banner-item',
                        'elementor-repeater-item-' . $item['_id'],
                    ] );
                    $class_attributes = $widget->get_render_attribute_string( $item_key );
                    $button_text = 'Read More';
                    if (!empty($item['button_text'])){
                        $button_text = $item['button_text'];
                    }
                    ?>
                    <div class="yhsshu-swiper-slide swiper-slide">
                        <div <?php yhsshu_print_html($class_attributes); ?> style="background-image: url(<?php echo esc_url($item['item_background']['url']); ?>);">
                            <div class="item-text">
                                <?php
                                if (!empty($item['title_text'])){
                                    ?>
                                    <h3 class="item-title">
                                        <?php echo yhsshu_print_html($item['title_text']); ?>
                                    </h3>
                                    <?php
                                }
                                if (!empty($item['description_text'])){
                                    ?>
                                    <div class="item-description">
                                        <?php echo esc_html($item['description_text']); ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="item-readmore">
                                    <a class="btn btn-outline-secondary-2" <?php yhsshu_print_html($link_attributes); ?>>
                                        <span><?php echo esc_html($button_text); ?></span>
                                    </a>
                                </div>
                            </div>
                            <?php
                                if (!empty($item['name_theme'])){
                                    ?>
                                    <div class="item-name">
                                        <?php echo yhsshu_print_html($item['name_theme']); ?>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
            <?php yhsshu_arrow_template($settings); ?>
        </div>
    </div>
<?php endif; ?>
