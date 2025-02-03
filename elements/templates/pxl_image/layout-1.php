<?php 

$widget->add_render_attribute( 'yhsshu_img_wrap', 'id', yhsshu_get_element_id($settings));
$widget->add_render_attribute( 'yhsshu_img_wrap', 'class', 'yhsshu-image-wg');

if(!empty($settings['custom_style'])){
	$widget->add_render_attribute( 'yhsshu_img_wrap', 'class', $settings['custom_style']);
	if(!empty($settings['draw_animation_delay'])){
		$widget->add_render_attribute( 'yhsshu_img_wrap', 'data-settings',
	        json_encode([
	            'animation_delay' => $settings['draw_animation_delay']
	        ])
	    );
	}
}

if(!empty($settings['yhsshu_parallax'])){
    $parallax_settings = json_encode([
        $settings['yhsshu_parallax'] => $settings['parallax_value'],
    ]);
    $widget->add_render_attribute( 'yhsshu_img_wrap', 'data-parallax', $parallax_settings );
}

if(!empty($settings['img_animation'])){
    $widget->add_render_attribute( 'yhsshu_img_wrap', 'class', $settings['img_animation']); 
}
if(!empty($settings['yhsshu_bg_parallax'])){
    $widget->add_render_attribute( 'yhsshu_img_wrap', 'class', 'yhsshu-bg-parallax yhsshu-pll-'.$settings['yhsshu_bg_parallax']); 
}
if(!empty($settings['yhsshu_bg_parallax']) && $settings['yhsshu_bg_parallax'] == 'transform-mouse-move'){
    $widget->add_render_attribute( 'yhsshu_img_wrap', 'class', 'yhsshu-parallax-background'); 
}
 
$data_parallax = yhsshu_get_parallax_effect_settings($settings);

$link = yhsshu_get_img_link_url( $settings );
 
if ( $link ) {
	$widget->add_link_attributes( 'link', $link );

	if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
		$widget->add_render_attribute( 'link', [
			'class' => 'elementor-clickable',
		] );
	}
	if ( 'file' === $settings['link_to'] ) {
		$widget->add_lightbox_data_attributes( 'link', $settings['image']['id'], $settings['open_lightbox'] );
	}
}	
 
?>
<div <?php yhsshu_print_html($widget->get_render_attribute_string( 'yhsshu_img_wrap' )); ?>>
	<?php if ( $link ) : ?><a <?php $widget->print_render_attribute_string( 'link' ); ?>><?php endif; ?>
		<?php \Elementor\Group_Control_Image_Size::print_attachment_image_html( $settings ); ?>
		<?php 
		if(!empty($settings['yhsshu_bg_parallax'])): 
			$image_src = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $settings['image']['id'], 'image', $settings );
		?>
			<div class="parallax-inner" <?php echo !empty($data_parallax) ? 'data-parallax="'.esc_attr($data_parallax).'"' : '';?>  style="--yhsshu-image-bg-parallax-inner: url(<?php echo esc_url($image_src) ?>)"></div>
		<?php endif; ?>
	<?php if ( $link ) : ?></a><?php endif; ?>
</div>
