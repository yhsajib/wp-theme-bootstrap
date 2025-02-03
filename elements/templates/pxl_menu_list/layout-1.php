<?php
$default_settings = [
    'list' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);

$animate_cls = '';
if (!empty($item_animation)) {
    $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
}
$item_animation_delay = !empty($item_animation_delay) ? $item_animation_delay : '200';

?>
<?php if(isset($list) && !empty($list) && count($list)): ?>
<div class="yhsshu-menu-list layout-1">
    <div class="yhsshu-item-list">
        <?php
        foreach ($list as $key => $value):
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

            $increase = $key + 1;
            $data_settings = '';
            if (!empty($item_animation)) {
                $data_animation =  json_encode([
                    'animation'      => $item_animation,
                    'animation_delay' => ((float)$item_animation_delay * $increase)
                ]);
                $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
            }
            ?>
            <div class="yhsshu-menu-item <?php echo esc_attr($animate_cls); ?> <?php echo 'elementor-repeater-item-' . $value['_id'] ?>" <?php yhsshu_print_html($data_settings); ?>>
                <?php if ($value['tag_1'] === 'yes' || $value['tag_2'] === 'yes') : ?>
                    <div class="custom-tags d-flex">
                        <?php if ($value['tag_1'] === 'yes' && !empty($value['tag_1_text'])) : ?>
                            <div class="custom-tag tag-1">
                                <?php echo esc_html($value['tag_1_text']); ?>
                            </div>
                        <?php endif;?>
                        <?php if ($value['tag_2'] === 'yes' && !empty($value['tag_2_text'])) : ?>
                            <div class="custom-tag tag-2">
                                <?php echo esc_html($value['tag_2_text']); ?>
                            </div>
                        <?php endif;?>
                    </div>
                <?php endif ?>
                <div class="d-flex align-items-center">
                    <?php if (!empty($value['selected_img']['id'])) :
                        $thumbnail = '';
                        $img  = yhsshu_get_image_by_size(array(
                            'attach_id'  => $value['selected_img']['id'],
                            'thumb_size' => '90x90',
                        ));
                        $thumbnail = $img['thumbnail'];
                        $image_position = isset($img_position) ? $img_position : '';
                        ?>
                        <div class="menu-icon <?php echo esc_attr($image_position); ?>">
                            <?php echo wp_kses_post($thumbnail); ?>
                        </div>
                    <?php endif; ?>
                    <div class="main-content">
                        <div class="d-flex align-items-center justify-content-between">
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
                            <?php if (!empty( $value['price'] )) : ?>
                                <div class="yhsshu-separator"></div>
                                <div class="menu-price">
                                    <?php echo yhsshu_print_html($value['price']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty( $value['sub_title'] )) : ?>
                            <div class="menu-sub-title">
                                <?php echo yhsshu_print_html($value['sub_title']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>