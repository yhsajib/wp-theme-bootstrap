<?php
$widget->add_render_attribute( 'counter', [
    'class' => 'yhsshu-counter-number-value',
    'data-startnumber' => $widget->get_setting('starting_number', 0),
    'data-endnumber' => $settings['ending_number'],
] );

if ( ! empty( $settings['thousand_separator'] ) ) {
    $delimiter = empty( $settings['thousand_separator_char'] ) ? '' : $settings['thousand_separator_char'];
    $widget->add_render_attribute( 'counter', 'data-delimiter', $delimiter );
}
 
?>
<div class="yhsshu-counter layout1">
    <div class="counter-inner">
        <div class="counter-content">
            <div class="counter-number">
                <?php if(!empty($settings['prefix'])) : ?>
                    <span class="counter-number-prefix"><?php echo yhsshu_print_html($settings['prefix']); ?></span>
                <?php endif; ?>
                <div <?php yhsshu_print_html($widget->get_render_attribute_string( 'counter' )); ?>><?php echo esc_html($settings['starting_number']); ?></div>
                <?php if(!empty($settings['suffix'])) : ?>
                    <span class="counter-number-suffix"><?php echo yhsshu_print_html($settings['suffix']); ?></span>
                <?php endif; ?>
            </div>
            <?php if ( $settings['title'] ) : ?>
                <div class="counter-title <?php echo esc_attr($settings['style']); ?>">
                    <span><?php yhsshu_print_html($settings['title']); ?></span>
                </div>
            <?php endif; ?>
        </div>
         
    </div>
</div>