<?php
if (isset($settings['links']) && !empty($settings['links']) && count($settings['links'])) : ?>
    <div class="yhsshu-dropdown-links layout-1">
        <div class="container-label d-flex align-items-center">
            <?php if (!empty($settings['selected_icon']['value'])) : ?>
                <div class="box-icon d-flex align-items-center">
                    <?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true', 'class' => 'yhsshu-dropdown-links yhsshu-icon'], 'i'); ?>
                </div>
            <?php endif; ?>
            <?php yhsshu_print_html($settings['container-label']); ?>
            <div class="dropdown-icon yhsshui yhsshui-angle-down"></div>
        </div>
        <ul class="links-group <?php echo esc_attr($settings['link_position']); ?>">
            <?php
            foreach ($settings['links'] as $key => $link) :
                $link_key = $widget->get_repeater_setting_key('link', 'links', $key);
                if (!empty($link['link']['url'])) {
                    $widget->add_render_attribute($link_key, 'href', $link['link']['url']);

                    if ($link['link']['is_external']) {
                        $widget->add_render_attribute($link_key, 'target', '_blank');
                    }

                    if ($link['link']['nofollow']) {
                        $widget->add_render_attribute($link_key, 'rel', 'nofollow');
                    }
                }
                $link_attributes = $widget->get_render_attribute_string($link_key);
            ?>
                <li>
                    <a <?php echo implode(' ', [$link_attributes]); ?>>
                        <span><?php yhsshu_print_html($link['text']); ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>