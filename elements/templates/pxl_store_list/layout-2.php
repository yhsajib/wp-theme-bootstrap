<?php
$default_settings = [
    'list' => '',
];
$settings = array_merge($default_settings, $settings);
$btn_style = $widget->get_settings('button_style', 'btn-additional-8');
extract($settings);
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<?php if(isset($list) && !empty($list) && count($list)): ?>
<div class="yhsshu-store-list layout-2">
    <?php
    foreach ($list as $key => $value):
        $link = isset($value['link']) ? $value['link'] : '';
        $link_key = $widget->get_repeater_setting_key( 'title', 'value', $key );
        $has_icon = !empty( $value['store_icon'] );
        if ( ! empty( $link['url'] ) ) {
            $widget->add_render_attribute( $link_key, 'href', $link['url'] );
            if ( $link['is_external'] ) {
                $widget->add_render_attribute( $link_key, 'target', '_blank' );
            }
            if ( $link['nofollow'] ) {
                $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
            }
        }
        $link_attributes = $widget->get_render_attribute_string( $link_key );
        $first = true;
        ?>
        <div class="yhsshu-store d-flex align-items-center justify-content-between" data-url="<?php echo esc_url($value['link']['url']); ?>">
            <div class="yhsshu-store-content d-flex align-items-center">
                <?php
                if ($has_icon){
                    echo '<div class="yhsshu-store-icon">';
                    if ($is_new){
                        \Elementor\Icons_Manager::render_icon( $value['store_icon'], [ 'aria-hidden' => 'true' ], 'i' );
                    }else{
                        ?><i class="<?php echo esc_attr($value['store_icon']);?>" aria-hidden="true"></i><?php
                    }
                    echo '</div>';
                }
                ?>
                <div>
                    <h5 class="yhsshu-store-title"><?php echo esc_html($value['title']); ?></h5>
                    <span class="yhsshu-store-desc"><?php echo esc_html($value['desc']); ?></span>
                </div>
            </div>
            <div class="yhsshu-store-btn">
                <i class="zmdi zmdi-check"></i>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="btn-wrapper">
        <a href="javascript:void(0)" class="btn store-submit <?php echo esc_attr($btn_style); ?>"><?php echo esc_html('Start Order', 'yhsshu'); ?></a>
    </div>
</div>
<?php endif; ?>