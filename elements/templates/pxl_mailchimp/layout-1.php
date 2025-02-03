<?php if(class_exists('MC4WP_Container')) : ?>
	<div class="yhsshu-mailchimp d-flex layout-1 <?php echo esc_html($settings['style']); ?><?php echo esc_html($settings['hide_icon']) == "true" ? ' hide-icon' : ''; ?><?php echo esc_html($settings['hide_button_text']) == "true" ? ' hide-button-text' : ''; ?><?php echo esc_html($settings['hide_lbcb']) == "true" ? ' hide-cblb' : ''; ?>">
		<div class="col">
		<?php echo do_shortcode('[mc4wp_form]'); ?>
		</div>
	</div>
<?php endif; ?>
