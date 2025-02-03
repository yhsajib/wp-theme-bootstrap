<?php
	$style = $widget->get_setting('style', 'style-1');
	$draw = $widget->get_setting('draw', '');
?>

<div class="yhsshu-widget-divider">
	<div class="yhsshu-divider <?php echo esc_html($style); ?><?php echo esc_html($draw) == 'true' ? ' yhsshu-scroll' : ''; ?>">
		<?php if ($style == 'style-2') : ?>
			<div class="diamond-icon"></div>
		<?php endif; ?>
	</div>
</div>