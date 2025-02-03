<?php
$default_settings = [
    'active_section' => '',
    'ac_items' => '',
    'style' => 'style1',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = yhsshu_get_element_id($settings);
$active_section = intval($active_section);
$accordions = $widget->get_settings('ac_items');
if(!empty($accordions)) : ?>
<div id="<?php echo esc_attr($html_id); ?>" class="yhsshu-accordion <?php echo esc_attr($style); ?>">
    <?php foreach ($accordions as $key => $value):
        $content_key = $widget->get_repeater_setting_key( 'ac_content', 'ac_items', $key );
        $is_active = ($key + 1) == $active_section;
        $_id = isset($value['_id']) ? $value['_id'] : '';
        $ac_title = isset($value['ac_title']) ? $value['ac_title'] : '';
        $ac_content_type = isset($value['ac_content_type']) ? $value['ac_content_type'] : 'text_editor';
        $ac_content = '';
        if($value['ac_content_type'] == 'template'){
            if(!empty($value['ac_content_template'])){
                $content = Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$value['ac_content_template']);
                $ac_content = $content;
            }
        }elseif($value['ac_content_type'] == 'text_editor'){
            $ac_content = $value['ac_content'];
        }

        $title_key = $widget->get_repeater_setting_key( 'ac_title', 'ac_items', $key );
        $widget->add_render_attribute( $title_key, [
            'class' => [ 'yhsshu-ac-title-text' ],
        ] );
        $widget->add_inline_editing_attributes( $title_key, 'basic' );
        $widget->add_render_attribute( $content_key, [
            'id' => $_id.$html_id,
            'class' => [ 'yhsshu-ac-content' ],
        ] );
        if($is_active){
            $widget->add_render_attribute( $content_key, 'style', 'display:block;' );
        }
        $widget->add_inline_editing_attributes( $content_key, 'basic' ); ?>
        <div class="yhsshu-ac-item elementor-repeater-item-<?php echo esc_attr($value['_id']); ?> <?php echo esc_attr($is_active?'active':''); ?>">
            <div class="yhsshu-ac-title <?php echo esc_attr($is_active?'active':''); ?>" data-target="<?php echo esc_attr('#' . $_id.$html_id); ?>">
                <span <?php yhsshu_print_html($widget->get_render_attribute_string( $title_key )); ?>><?php yhsshu_print_html($ac_title); ?></span>
            </div>
            <div <?php yhsshu_print_html($widget->get_render_attribute_string( $content_key )); ?>>
                <div class="yhsshu-ac-content-inner">
                    <?php yhsshu_print_html($ac_content); ?>
                </div>
            </div>
        </div>
        <?php
        endforeach;
        ?>
</div>
<?php endif; ?>