<?php
$default_settings = [
    'list' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<?php if(isset($list) && !empty($list) && count($list)): ?>
    <div class="yhsshu-list layout-2">
        <div class="yhsshu-item-list">
            <?php
            foreach ($list as $key => $value):
                $link = isset($value['link']) ? $value['link'] : '';
                $link_key = $widget->get_repeater_setting_key( 'content', 'value', $key );
                $has_icon = !empty( $value['list_icon'] );
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
                ?>
                <div class="yhsshu-list-content">
                    <?php
                    if ($has_icon){
                        echo '<div class="yhsshu-list-icon">';
                        if ($is_new){
                            \Elementor\Icons_Manager::render_icon( $value['list_icon'], [ 'aria-hidden' => 'true' ] );
                        }else{
                            ?><i class="<?php echo esc_attr($value['list_icon']);?>" aria-hidden="true"></i><?php
                        }
                        echo '</div>';
                    }
                    ?>
                    <?php if (!empty( $value['link']['url'] ) ) { ?><a <?php echo implode( ' ', [ $link_attributes ] ); ?>><?php } ?>
                    <span><?php echo yhsshu_print_html($value['content']); ?></span>
                    <?php if (!empty( $value['link']['url'] ) ) { ?></a><?php } ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>