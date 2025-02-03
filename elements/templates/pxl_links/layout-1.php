<?php 
if(isset($settings['links']) && !empty($settings['links']) && count($settings['links'])): ?>
    <ul class="yhsshu-links d-flex flex-column layout-1">
        <?php
            foreach ($settings['links'] as $key => $link):
                $link_key = $widget->get_repeater_setting_key( 'link', 'links', $key );
                if ( ! empty( $link['link']['url'] ) ) {
                    $widget->add_render_attribute( $link_key, 'href', $link['link']['url'] );

                    if ( $link['link']['is_external'] ) {
                        $widget->add_render_attribute( $link_key, 'target', '_blank' );
                    }

                    if ( $link['link']['nofollow'] ) {
                        $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                    }
                }
                $link_attributes = $widget->get_render_attribute_string( $link_key );
                ?>
                <li>
                    <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                        <span><?php yhsshu_print_html($link['text']); ?></span>
                    </a>
                </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
