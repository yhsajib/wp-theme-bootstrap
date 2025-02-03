<?php
use Elementor\Utils;
$default_settings = [
    'title' => '',
    'title_tag' => 'h3',
    'sub_title' => '',
    'sub_title_style' => '',
    'text_align' => '',
    'yhsshu_icon' => '',
    'text_list' => '',
];
$settings = array_merge($default_settings, $settings);
// $hightlight_list = $widget->get_settings('text_list');
// $list_array = [];
// if(count($hightlight_list) > 0){
//     foreach ($hightlight_list as $key => $list) {
//         $list_array[] = $list['highlight_text']; 
//     }
// }
$widget->add_render_attribute( 'wrap-heading', 'class', 'yhsshu-heading-wrap d-flex layout1');

// $widget->add_render_attribute( 'large-icecream', 'class', 'none');
// if ( $settings['highlighted_cream'] == "true") {
//     $widget->add_render_attribute( 'large-icecream', 'class', 'icecream-heading');
//     $widget->add_render_attribute( 'large-icecream', 'class', $settings['highlighted_cream_style']);
// }
$widget->add_render_attribute( 'large-title', 'class', 'heading-title');
if ( $settings['title_highlighted_line'] == "true") {
    $widget->add_render_attribute( 'large-title', 'class', 'highlighted');
    $widget->add_render_attribute( 'large-title', 'class', $settings['title_highlighted_style']);
}
if(!empty($settings['title_split_text_anm'])){
    $widget->add_render_attribute( 'large-title', 'class', 'yhsshu-split-text '.$settings['title_split_text_anm']);
}
if ( $settings['title_animation'] ) {
    $widget->add_render_attribute( 'large-title', 'class', 'yhsshu-animate yhsshu-invisible animated-'.$settings['title_animation_duration']);
    $widget->add_render_attribute( 'large-title', 'data-settings',
        json_encode([
            'animation'      => $settings['title_animation'],
            'animation_delay' => $settings['title_animation_delay']
        ])
    );
}

$widget->add_render_attribute( 'sub-title', 'class', 'heading-subtitle');
if ($settings['subtitle_highlighted_line'] == "true") {
    $widget->add_render_attribute( 'sub-title', 'class', 'highlighted');
    $widget->add_render_attribute( 'sub-title', 'class', $settings['subtitle_highlighted_style']);
}
if ( $settings['sub_title_animation'] ) {
    $widget->add_render_attribute( 'sub-title', 'class', 'yhsshu-animate yhsshu-invisible animated-'.$settings['sub_title_animation_duration']);
    $widget->add_render_attribute( 'sub-title', 'data-settings',
        json_encode([
            'animation'      => $settings['sub_title_animation'],
            'animation_delay' => $settings['sub_title_animation_delay']
        ])
    );
}

$widget->add_render_attribute( 'sub-title-text', 'class', 'subtitle-text ');
if(!empty($settings['subtitle_split_text_anm'])){
    $widget->add_render_attribute( 'sub-title-text', 'class', 'yhsshu-split-text '.$settings['subtitle_split_text_anm']);
}

$widget->add_render_attribute( 'description', 'class', 'heading-description');
if ( $settings['description_animation'] ) {
    $widget->add_render_attribute( 'description', 'class', 'yhsshu-animate yhsshu-invisible animated-'.$settings['description_animation_duration']);
    $widget->add_render_attribute( 'description', 'data-settings',
        json_encode([
            'animation'      => $settings['description_animation'],
            'animation_delay' => $settings['description_animation_delay']
        ])
    );
}
if(!empty($settings['description_split_text_anm'])){
    $widget->add_render_attribute( 'description', 'class', 'yhsshu-split-text '.$settings['description_split_text_anm']);
}

if ( ! empty( $settings['link']['url'] ) ) {
    $widget->add_render_attribute( 'link', 'href', $settings['link']['url'] );
    $inner_tag = 'a';
    if ( $settings['link']['is_external'] ) {
        $widget->add_render_attribute( 'link', 'target', '_blank' );
    } 

    if ( $settings['link']['nofollow'] ) {
        $widget->add_render_attribute( 'link', 'rel', 'nofollow' );
    }

    if ( ! empty( $settings['link']['custom_attributes'] ) ) {
        // Custom URL attributes should come as a string of comma-delimited key|value pairs
        $custom_attributes = Utils::parse_custom_attributes( $settings['link']['custom_attributes'] );
        $widget->add_render_attribute( 'link', $custom_attributes);
    }
}

$link_attributes = $widget->get_render_attribute_string( 'link' );
extract($settings);

?>
<div <?php yhsshu_print_html($widget->get_render_attribute_string( 'wrap-heading' )); ?>>
    <div class="yhsshu-heading-inner">
        <?php if($settings["title_highlighted_style"] == 'style-3') : ?>
            <span class="icecream-heading"></span>
        <?php endif; ?>
        <?php if(!empty($sub_title)) : ?>
            <div <?php yhsshu_print_html($widget->get_render_attribute_string( 'sub-title' )); ?>>
                <span <?php yhsshu_print_html($widget->get_render_attribute_string( 'sub-title-text' )); ?>><?php yhsshu_print_html(nl2br($sub_title)); ?></span>
            </div>
        <?php endif; ?>
        <<?php echo esc_attr($title_tag); ?> <?php yhsshu_print_html($widget->get_render_attribute_string( 'large-title' )); ?>>
            <?php if (!empty( $settings['link']['url']) ) : ?>
                <<?php echo implode( ' ', [ $inner_tag, $link_attributes ] ); ?>>
            <?php endif; ?>
            <?php echo wp_kses_post(nl2br($title)); ?>
            <?php if (!empty( $settings['link']['url']) ) : ?>
                </<?php yhsshu_print_html($inner_tag); ?>>
            <?php endif; ?>
        </<?php echo esc_attr($title_tag); ?>>
        <?php if(!empty($description)) : ?>
            <div <?php yhsshu_print_html($widget->get_render_attribute_string( 'description' )); ?>>
                <span><?php yhsshu_print_html(nl2br($description)); ?></span>
            </div>
        <?php endif; ?>
    </div>
</div>