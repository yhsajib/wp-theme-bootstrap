<?php
use Elementor\Icons_Manager;
use Elementor\Utils;
Icons_Manager::enqueue_shim();
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
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<div class="yhsshu-team-details layout-1">
    <div class="content-inner">
        <?php
        $image    = isset($settings['image']) ? $settings['image'] : [];
        $hi_text = isset($settings['hi_text']) ? $settings['hi_text'] : '';
        $title    = isset($settings['title']) ? $settings['title'] : '';
        $position = isset($settings['position']) ? $settings['position'] : '';
        $link     = isset($settings['link']) ? $settings['link'] : '';
        $thumbnail = '';
        if(!empty($image)) {
            $img = yhsshu_get_image_by_size( array(
                'attach_id'  => $image['id'],
                'thumb_size' => 'full',
                'class' => 'no-lazyload',
            ));
            $thumbnail = $img['thumbnail'];
        }

        $social = isset($settings['social']) ? $settings['social'] : '';
        if (!empty($thumbnail)){
            ?>
            <div class="image-wrap">
                <div class="item-image">
                    <?php echo wp_kses_post($thumbnail); ?>
                </div>
                <?php if(!empty($hi_text)) { ?>
                    <div class="hi-text" style="background-image: url(<?php echo esc_url($settings['item_background']['url']); ?>);">
                        <h4><?php echo esc_html($hi_text); ?></h4>
                    </div>
                <?php } ?>
            </div>
            <?php
        }
        ?>
        <div class="info-wrap">
            <div class="name-wrap">
                <h3 class="item-name">
                    <?php if ( $link_attributes ) echo '<a '. implode( ' ', [ $link_attributes ] ).'>'; ?>
                    <?php yhsshu_print_html( nl2br($widget->get_setting('title'))); ?>
                    <?php if ( $link_attributes ) echo '</a>'; ?>
                </h3>
                <div class="item-position"><?php echo yhsshu_print_html($position); ?></div>
            </div>
            <div class="contact-wrap">
                <?php
                foreach( $settings['contact_list'] as $item ):
                    ?>
                    <div class="item-contact">
                        <?php
                        if($is_new):
                            \Elementor\Icons_Manager::render_icon( $item['contact_icon'], [ 'aria-hidden' => 'true' ] );
                            ?>
                        <?php else: ?>
                            <i class="<?php echo esc_attr( $item['contact_icon'] ); ?>"></i>
                        <?php endif; ?>
                        <span class="text-info"><?php yhsshu_print_html($item['contact_info']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if(!empty($social)): ?>
                <div class="social-wrap">
                    <?php
                    $team_social = json_decode($social, true);
                    foreach ($team_social as $settings): ?>
                        <a href="<?php echo esc_url($settings['url']); ?>" target="_blank">
                            <i class="yhsshui <?php echo esc_attr($settings['icon']); ?>"></i>
                        </a>
                    <?php endforeach;?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
