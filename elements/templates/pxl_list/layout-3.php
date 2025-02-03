<?php
$default_settings = [
    'list_layout3' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<?php if(isset($list_layout3) && !empty($list_layout3) && count($list_layout3)): ?>
    <div class="yhsshu-list layout-3">
        <div class="yhsshu-item-list">
            <?php
            foreach ($list_layout3 as $key => $value):
                $link = isset($value['link_layout3']) ? $value['link_layout3'] : '';
                $link_key = $widget->get_repeater_setting_key( 'content_link', 'value', $key );
                $has_icon = !empty( $value['list_icon_layout3'] );
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
                <div class="yhsshu-list-content elementor-repeater-item-<?php echo esc_attr($value['_id']); ?>">
                    <?php
                    if ($has_icon){
                        echo '<div class="yhsshu-list-icon">';
                        if ($is_new){
                            \Elementor\Icons_Manager::render_icon( $value['list_icon_layout3'], [ 'aria-hidden' => 'true' ] );
                        }else{
                            ?><i class="<?php echo esc_attr($value['list_icon_layout3']);?>" aria-hidden="true"></i><?php
                        }
                        echo '</div>';
                    }
                    ?>
                    <span class="box-content">
                        <?php echo yhsshu_print_html($value['content_layout3']); ?>
                        <?php if (!empty( $value['link_layout3']['url'] ) ) { ?><a <?php echo implode( ' ', [ $link_attributes ] ); ?>><?php } ?>
                            <?php echo yhsshu_print_html($value['content_link']); ?>
                        <?php if (!empty( $value['link_layout3']['url'] ) ) { ?></a><?php } ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>