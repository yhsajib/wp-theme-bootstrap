<?php
extract($settings);
$img_size = !empty( $img_size ) ? $img_size : 'full'; 
if(count($tabs_list) > 0){
	$tab_bd_ids = [];
    ?>
    <div class="yhsshu-tabs layout-16">
        <?php if (!empty($link_to_carousel)) : ?>
            <div class="link-to-tabs-carousel-id d-none">
                <?php echo esc_attr($link_to_carousel); ?>
            </div>
        <?php endif; ?>
        <div class="tabs-title">
            <div class="title-wrap">
                <?php foreach ($tabs_list as $key => $tab) :
                    $title_key = $widget->get_repeater_setting_key( 'tab_title', 'tabs_list', $key );
                    $title_key = $widget->get_repeater_setting_key( 'item_image', 'tabs_list', $key );
                    $item_image    = isset($tab['item_image']) ? $tab['item_image'] : [];
                    $tabs_title[$title_key] = $tab['tab_title'];
                    $widget->add_inline_editing_attributes( $title_key, 'basic' );
                    $widget->add_render_attribute( $title_key, [
                        'class' => [ 'tab-title' ],
                        'data-target' => '#' . $element_id.'-'.$tab['_id'],
                    ] );
                    if($active_tab == $key + 1){
                        $widget->add_render_attribute( $title_key, 'class', 'active');
                    }
                    $thumbnail = '';
                    if(!empty($item_image)) {
                        $img = yhsshu_get_image_by_size( array(
                            'attach_id'  => $item_image['id'],
                            'thumb_size' => $img_size,
                            'class' => 'no-lazyload',
                        ));
                        if (is_array($img) && isset($img['thumbnail'])) {
                            $thumbnail = $img['thumbnail'];
                        }
                    }
                    ?>
                    <div <?php yhsshu_print_html($widget->get_render_attribute_string( $title_key )); ?> data-slide="<?php echo esc_attr($key); ?>">
                        <div class="item-image">
                            <?php echo wp_kses_post($thumbnail); ?>
                        </div>
                        <span><?php echo yhsshu_print_html($tab['tab_title']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="yhsshu-tab-arrows">
                <div class="yhsshu-tab-arrow yhsshu-tab-arrow-prev"><span class="yhsshu-icon yhsshui yhsshui-arrow-prev"></span></div>
                <div class="yhsshu-tab-arrow yhsshu-tab-arrow-next"><span class="yhsshu-icon yhsshui yhsshui-arrow-next"></span></div>
            </div>
        </div>
        <div class="tabs-content <?php echo esc_attr($tab_animation); ?>">
            <?php foreach ($tabs_list as $key => $tab):
                $content_key = $widget->get_repeater_setting_key( 'tab_content', 'tabs_list', $key );
                $tabs_content = '';
                if($tab['content_type'] == 'template'){
                    if(!empty($tab['content_template'])){
                        $content = Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$tab['content_template']);
                        $tabs_content = $content;
                        $tab_bd_ids[] = (int)$tab['content_template'];
                    }
                }elseif($tab['content_type'] == 'df'){
                    $tabs_content = $tab['tab_content'];
                }
                $widget->add_render_attribute( $content_key, [
                    'class' => [ 'tab-content' ],
                    'id' => $element_id.'-'.$tab['_id'],
                ] );
                if($tab['content_type'] == 'df'){
                    $widget->add_inline_editing_attributes( $content_key, 'advanced' );
                }
                if($active_tab == $key + 1){
                    $widget->add_render_attribute( $content_key, 'class', 'active');
                }
                ?>
                <div <?php yhsshu_print_html($widget->get_render_attribute_string( $content_key )); ?>><?php yhsshu_print_html($tabs_content); ?></div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}
?>