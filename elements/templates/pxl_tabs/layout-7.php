<?php
extract($settings);

if(count($tabs_list) > 0){
	$tab_bd_ids = [];
    ?>
    <div class="yhsshu-tabs layout-7">
        <?php if (!empty($link_to_carousel)) : ?>
            <div class="link-to-tabs-carousel-id d-none">
                <?php echo esc_attr($link_to_carousel); ?>
            </div>
        <?php endif; ?>
        <div class="tabs-title">
            <div class="title-wrap">
                <?php foreach ($tabs_list as $key => $tab) :
                    $title_key = $widget->get_repeater_setting_key( 'tab_title', 'tabs_list', $key );
                    $tabs_title[$title_key] = $tab['tab_title'];
                    $widget->add_inline_editing_attributes( $title_key, 'basic' );
                    $widget->add_render_attribute( $title_key, [
                        'class' => [ 'tab-title' ],
                        'data-target' => '#' . $element_id.'-'.$tab['_id'],
                    ] );
                    if($active_tab == $key + 1){
                        $widget->add_render_attribute( $title_key, 'class', 'active');
                    }
                    ?>
                    <span <?php yhsshu_print_html($widget->get_render_attribute_string( $title_key )); ?> data-slide="<?php echo esc_attr($key); ?>">
                        <?php if(! empty( $tab['tab_icon']['value'] )): ?>
                            <div class="title-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $tab['tab_icon'], [ 'aria-hidden' => 'true', 'class' => 'yhsshu-fancy-icon yhsshu-icon' ], 'i' );?>
                            </div>
                        <?php endif; ?>
                        <span><?php echo yhsshu_print_html($tab['tab_title']); ?></span>
                    </span>
                <?php endforeach; ?>
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