<?php
use Elementor\Utils;
if(!empty($settings['link']['url'])){
    $widget->add_render_attribute( 'link', 'href', $settings['link']['url'] );
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
$thumbnail = '';
if( ! empty( $settings['selected_img']['id'] ) ){
    $img  = yhsshu_get_image_by_size( array(
        'attach_id'  => $settings['selected_img']['id'],
        'thumb_size' => 'full',
    ) );
    $thumbnail = $img['thumbnail'];
}
?>

<div class="yhsshu-fancy-box layout-7">
    <div class="box-inner" <?php if($settings['background_img']['url']) : ?>style="background-image: url(<?php echo esc_url($settings['background_img']['url']); ?>);" <?php endif; ?>>
        <div class="box-content">
            <?php if(!empty($widget->get_setting('title'))): ?>
                <h3 class="box-title">
                    <?php if ( $link_attributes ) echo '<a '. implode( ' ', [ $link_attributes ] ).'>'; ?>
                    <?php yhsshu_print_html( nl2br($widget->get_setting('title'))); ?>
                    <?php if ( $link_attributes ) echo '</a>'; ?> 
                </h3>
            <?php endif; ?>
            <?php if(!empty($widget->get_setting('description'))): ?>
                <div class="box-description">
                    <?php yhsshu_print_html($widget->get_setting('description')); ?>
                </div>
            <?php endif; ?>
            <?php if($thumbnail) : ?>
                <div class="box-image">
                    <?php echo wp_kses_post($thumbnail); ?>
                </div>
            <?php endif; ?>
            <div class="box-btn">
                <?php if ( $link_attributes ) echo '<a '. implode( ' ', [ $link_attributes ] ).'>'; ?>
                <i class="zmdi zmdi-arrow-right"></i>
                <?php if ( $link_attributes ) echo '</a>'; ?> 
            </div>
        </div>
    </div>  
</div>