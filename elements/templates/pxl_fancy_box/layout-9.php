<?php
use Elementor\Utils;
$default_settings = [
    'boxs_des' => [],
];
$settings = array_merge($default_settings, $settings);
extract($settings);
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

?>
 
<div class="yhsshu-fancy-box layout-9">
    <div class="box-inner">
        <div class="box-title-icon">
            <?php if(!empty($widget->get_setting('title'))): ?>
                <h3 class="box-title">
                        <?php yhsshu_print_html( nl2br($widget->get_setting('title'))); ?>
                </h3>
            <?php endif; ?>
            <div class="box-icon">
                <span class="yhsshu-icon">
                    <?php if(! empty( $settings['selected_icon']['value'] )): ?>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true', 'class' => 'yhsshu-fancy-icon yhsshu-icon' ], 'i' );?>
                    <?php endif; ?>
                </span>
            </div>
        </div>
        <?php if(isset($boxs_des) && !empty($boxs_des) && count($boxs_des)): ?>
            <div class="box-description">
                <?php foreach ($boxs_des as $box): ?>
                    <?php if (!empty($box['des_layout9'])){ ?>
                        <span>
                            <?php echo yhsshu_print_html($box['des_layout9']); ?>
                        </span>
                    <?php } ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if(!empty($widget->get_setting('button_text'))): ?>
        <div class="box-readmore">
            <?php if ( $link_attributes ) echo '<a '. implode( ' ', [ $link_attributes ] ).'>'; ?>
            <?php
                yhsshu_print_html($widget->get_setting('button_text'));
            ?>
            <i class="yhsshui-angle-right"></i>
            <?php if ( $link_attributes ) echo '</a>'; ?> 
        </div>
        <?php endif; ?>
    </div>  
</div>