<?php
extract($settings);
$img_size = !empty( $img_size ) ? $img_size : '270x305'; 
if(count($tabs_list_2) > 0){
	$tab_bd_ids = [];
    ?>
    <div class="yhsshu-tabs layout-14">
        <div class="tabs-title">
            <div class="image-wrap">
                <?php foreach ($tabs_list_2 as $key => $tab) :
                    $image_key = $widget->get_repeater_setting_key( 'image', 'tabs_list_2', $key );
                    $image    = isset($tab['image']) ? $tab['image'] : [];
                    $widget->add_inline_editing_attributes( $image_key, 'basic' );
                    $widget->add_render_attribute( $image_key, [
                        'class' => [ 'tab-title' ],
                        'data-target' => '#' . $element_id.'-'.$tab['_id'],
                    ] );
                    if($active_tab == $key + 1){
                        $widget->add_render_attribute( $image_key, 'class', 'active');
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
                    <a href="javascript:void(0)" <?php yhsshu_print_html($widget->get_render_attribute_string( $image_key )); ?> data-slide="<?php echo esc_attr($key); ?>">
                        <div class="item-image scale-hover-x">
                            <?php echo wp_kses_post($thumbnail); ?>
                        </div>
                    </a>
                    <?php } ?> 
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tabs-content <?php echo esc_attr($tab_animation); ?>">
            <?php foreach ($tabs_list_2 as $key => $tab):
                $content_key = $widget->get_repeater_setting_key( 'description', 'tabs_list_2', $key );
                $content_key = $widget->get_repeater_setting_key( 'tab_title_2', 'tabs_list_2', $key );
                $content_key = $widget->get_repeater_setting_key( 'position', 'tabs_list_2', $key );
                $tabs_content = '';
                $widget->add_render_attribute( $content_key, [
                    'class' => [ 'tab-content' ],
                    'id' => $element_id.'-'.$tab['_id'],
                ]);
                if($active_tab == $key + 1){
                    $widget->add_render_attribute( $content_key, 'class', 'active');
                }
                ?>
                <div <?php yhsshu_print_html($widget->get_render_attribute_string( $content_key )); ?>><?php yhsshu_print_html($tabs_content); ?>
                    <h2 class="item-title"><?php echo yhsshu_print_html($tab['tab_title_2']); ?></h2>
                    <div class="item-position"><?php echo yhsshu_print_html($tab['position']); ?></div>
                    <span class="item-des"><?php echo yhsshu_print_html($tab['description']); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}
?>