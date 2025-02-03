<?php
use Elementor\Utils;

$widget->add_render_attribute( 'wrapper', 'class', 'yhsshu-button-more' );
$link_type = $settings['button_url_type'];
if(($link_type == 'url') && !empty( $settings['link']['url'])){
    $widget->add_render_attribute( 'button', 'href', $settings['link']['url'] );
    if ( $settings['link']['is_external'] ) {
        $widget->add_render_attribute( 'button', 'target', '_blank' );
    }
    if ( $settings['link']['nofollow'] ) {
        $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
    }
    if ( ! empty( $settings['link']['custom_attributes'] ) ) {
        // Custom URL attributes should come as a string of comma-delimited key|value pairs
        $custom_attributes = Utils::parse_custom_attributes( $settings['link']['custom_attributes'] );
        $widget->add_render_attribute( 'link', $custom_attributes);
    }
}
if ($link_type == 'page') {
    $page_url = get_permalink($settings['page_link']);
    $widget->add_render_attribute( 'button', 'href', $page_url );
}

$widget->add_render_attribute( 'button', 'class', 'btn-more '.$settings['style'].' ' );
$html_id = yhsshu_get_element_id($settings);

?>
<div id="<?php echo esc_attr($html_id); ?>" <?php yhsshu_print_html($widget->get_render_attribute_string( 'wrapper' )); ?>>
    <a <?php yhsshu_print_html($widget->get_render_attribute_string( 'button' )); ?>>
        <?php
		$widget->add_inline_editing_attributes( 'text', 'none' ); ?>
        <span class="yhsshu-button-text"><?php echo esc_html($settings['text']); ?></span>
        <i class="zmdi zmdi-long-arrow-right"></i>
    </a>
</div>