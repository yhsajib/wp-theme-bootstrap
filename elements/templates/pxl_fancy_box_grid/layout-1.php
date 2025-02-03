<?php
use Elementor\Icons_Manager;
use Elementor\Utils;
Icons_Manager::enqueue_shim();
$default_settings = [
    'col_xxl' => '3',
    'col_xl' => '3',
    'col_lg' => '2',
    'col_md' => '2',
    'col_sm' => '2',
    'col_xs' => '1',
    'content_list' => []
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$col_xxl = 'col-xxl-'.str_replace('.', '',12 / floatval( $settings['col_xxl']));
$col_xl  = 'col-xl-'.str_replace('.', '',12 / floatval( $settings['col_xl']));
$col_lg  = 'col-lg-'.str_replace('.', '',12 / floatval( $settings['col_lg']));
$col_md  = 'col-md-'.str_replace('.', '',12 / floatval( $settings['col_md']));
$col_sm  = 'col-sm-'.str_replace('.', '',12 / floatval( $settings['col_sm'])); 
$col_xs  = 'col-'.str_replace('.', '',12 / floatval( $settings['col_xs'])); 

$item_class = trim(implode(' ', ['grid-item', $col_xxl, $col_xl, $col_lg, $col_md, $col_sm, $col_xs]));
$grid_sizer = trim(implode(' ', [ $col_xxl, $col_xl, $col_lg, $col_md, $col_sm, $col_xs]));

$animate_cls = '';
if ( !empty( $item_animation ) ) {
    $animate_cls = ' yhsshu-animate yhsshu-invisible animated-'.$item_animation_duration;
} 
$item_animation_delay = !empty($item_animation_delay) ? $item_animation_delay : '200';

$img_size = !empty( $img_size ) ? $img_size : '570x630';

$widget->add_render_attribute( 'yhsshu_img_wrap', 'id', yhsshu_get_element_id($settings));
$widget->add_render_attribute( 'yhsshu_img_wrap', 'class', 'yhsshu-image-wg');
if(!empty($settings['yhsshu_parallax'])){
    $parallax_settings = json_encode([
        $settings['yhsshu_parallax'] => $settings['parallax_value'],
    ]);
    $widget->add_render_attribute( 'yhsshu_img_wrap', 'data-parallax', $parallax_settings );
}
$data_parallax = yhsshu_get_parallax_effect_settings($settings);

if(is_admin())
    $grid_class = 'yhsshu-grid-inner yhsshu-grid-masonry-adm row relative';
else
    $grid_class = 'yhsshu-grid-inner yhsshu-grid-masonry row relative';

?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list)): ?>
    <div class="yhsshu-grid yhsshu-fancy-box-grid layout-1" data-layout-mode="fitRows">
        <div class="<?php echo esc_attr($grid_class) ?>">
            <?php foreach ($content_list as $key => $value):
                $title    = isset($value['title']) ? $value['title'] : '';
                $categories = isset($value['categories']) ? $value['categories'] : '';
                $image    = isset($value['image']) ? $value['image'] : [];
                $link     = isset($value['link']) ? $value['link'] : '';  
                $thumbnail = '';
                if(!empty($image)) {
                    $img = yhsshu_get_image_by_size( array(
                        'attach_id'  => $image['id'],
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
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
                $increase = $key + 1; 
                $data_settings = '';
                if ( !empty( $item_animation ) ) {
                    $data_animation =  json_encode([
                        'animation'      => $item_animation,
                        'animation_delay' => ((float)$item_animation_delay * $increase)
                    ]);
                    $data_settings = 'data-settings="'.esc_attr($data_animation).'"';
                }
                ?>
                <div class="<?php echo esc_attr($item_class.' '.$animate_cls); ?>" <?php yhsshu_print_html($data_settings); ?>>
                    <div class="item-inner elementor-repeater-item-<?php echo esc_attr($value['_id']); ?>">
                        <?php if(!empty($thumbnail)) { ?>
                            <div class="item-image">
                                <div class="image-wrap" <?php yhsshu_print_html($widget->get_render_attribute_string( 'yhsshu_img_wrap' )); ?>>
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="item-content">
                            <h3 class="item-title">
                                <?php if ( ! empty( $link['url'] ) ): ?><a <?php echo implode( ' ', [ $link_attributes ] ); ?>><?php endif; ?>
                                <?php echo yhsshu_print_html($title); ?>
                                <?php if ( ! empty( $link['url'] ) ): ?></a><?php endif; ?>
                            </h3>
                            <?php if(!empty($categories)) { ?>
                                <div class="item-categories"><?php echo yhsshu_print_html($categories); ?></div>
                            <?php } ?>
                        </div>
                    </div> 
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
