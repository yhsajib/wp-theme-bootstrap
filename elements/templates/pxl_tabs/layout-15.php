<?php
extract($settings);
$img_size = !empty( $img_size ) ? $img_size : '570x641'; 
if(count($tabs_list_2) > 0){
	$tab_bd_ids = [];
    ?>
    <div class="yhsshu-tabs layout-15 row overflow-hidden">
        <?php if (!empty($link_to_carousel)) : ?>
            <div class="link-to-tabs-carousel-id d-none">
                <?php echo esc_attr($link_to_carousel); ?>
            </div>
        <?php endif; ?>
        <div class="tabs-title col-6">
            <div class="title-wrap">
                <?php foreach ($tabs_list_2 as $key => $tab) :
                    $title_key = $widget->get_repeater_setting_key( 'tab_title_2', 'tabs_list', $key );
                    $title_key = $widget->get_repeater_setting_key( 'description', 'tabs_list_2', $key );
                    $title_key = $widget->get_repeater_setting_key( 'button_text', 'tabs_list_2', $key );
                    $title_key = $widget->get_repeater_setting_key( 'position', 'tabs_list_2', $key );
                    $tabs_title[$title_key] = $tab['tab_title_2'];
                    $widget->add_inline_editing_attributes( $title_key, 'basic' );
                    $widget->add_render_attribute( $title_key, [
                        'class' => [ 'tab-title' ],
                        'data-target' => '#' . $element_id.'-'.$tab['_id'],
                    ] );
                    if($active_tab == $key + 1){
                        $widget->add_render_attribute( $title_key, 'class', 'active');
                    }
                    $link     = isset($tab['link']) ? $tab['link'] : '';
                    $link_key = $widget->get_repeater_setting_key( 'link', 'tabs_list_2', $key );
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
                    <div href="javascript:void(0)" <?php yhsshu_print_html($widget->get_render_attribute_string( $title_key )); ?> data-slide="<?php echo esc_attr($key); ?>">
                        <span><?php echo yhsshu_print_html($tab['tab_title_2']); ?></span>
                        <div class="box-content">
                            <span class="item-des"><?php echo yhsshu_print_html($tab['description']); ?></span>
                            <?php if(!empty($tab['position'])) { ?>
                            <span class="item-position"><?php echo yhsshu_print_html($tab['position']); ?></span>
                            <?php } ?>
                            <div class="button-more">
                                <?php if ( ! empty( $link['url'] ) ): ?><a class="btn-more" <?php echo implode( ' ', [ $link_attributes ] ); ?>><?php endif; ?>
                                    <span><?php echo yhsshu_print_html($tab['button_text']); ?></span>
                                    <i class="zmdi zmdi-long-arrow-right"></i>
                                <?php if ( ! empty( $link['url'] ) ): ?></a><?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tabs-content col-6 <?php echo esc_attr($tab_animation); ?>">
            <?php foreach ($tabs_list_2 as $key => $tab):
                $content_key = $widget->get_repeater_setting_key( 'image', 'tabs_list_2', $key );
                $image    = isset($tab['image']) ? $tab['image'] : [];
                $tabs_content = '';
                $widget->add_render_attribute( $content_key, [
                    'class' => [ 'tab-content' ],
                    'id' => $element_id.'-'.$tab['_id'],
                ]);
                if($active_tab == $key + 1){
                    $widget->add_render_attribute( $content_key, 'class', 'active');
                }
                $thumbnail = '';
                if(!empty($image)) {
                    $img = yhsshu_get_image_by_size( array(
                        'attach_id'  => $image['id'],
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                }
                ?>
                 <?php if(!empty($thumbnail)) { ?>
                <div <?php yhsshu_print_html($widget->get_render_attribute_string( $content_key )); ?>><?php yhsshu_print_html($tabs_content); ?>
                    <div class="item-image scale-hover-x">
                        <?php echo wp_kses_post($thumbnail); ?>
                    </div>
                </div>
                <?php } ?> 
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}
?>