<?php
$default_settings = [
    'history_items' => [],
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$count = 0;
?>

<?php if (isset($history_items) && !empty($history_items) && count($history_items)) : ?>
    <div class="yhsshu-history layout-<?php echo esc_attr($settings['layout']) ?>">
        <div class="yhsshu-inner-history">
            <?php foreach ($history_items as $key => $value) :
                $title = isset($value['title']) ? $value['title'] : '';
                $description = isset($value['description']) ? $value['description'] : '';
                $year = isset($value['year']) ? $value['year'] : '';
                $history_img = isset($value['history_img']) ? $value['history_img'] : [];
                $image_link = isset($value['image_link']) ? $value['image_link'] : [];
                $thumbnail1 = '';
                if (!empty($history_img['id'])) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $history_img['id'],
                        'thumb_size' => 'full',
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail1 = $img['thumbnail'];
                }

                $link_key = $widget->get_repeater_setting_key('image_link', 'history_items', $key);
                if (!empty($image_link['url'])) {
                    $widget->add_render_attribute($link_key, 'href', $image_link['url']);

                    if ($image_link['is_external']) {
                        $widget->add_render_attribute($link_key, 'target', '_blank');
                    }

                    if ($image_link['nofollow']) {
                        $widget->add_render_attribute($link_key, 'rel', 'nofollow');
                    }

                    if (!empty($image_link['custom_attributes'])) {
                        $custom_attributes = explode('|', $image_link['custom_attributes']);
                        foreach ($custom_attributes as $atts_value) {
                            $_custom_attributes = explode(':', $atts_value);
                            $widget->add_render_attribute($link_key, $_custom_attributes[0], $_custom_attributes[1]);
                        }
                    }
                }
                $link_attributes = $widget->get_render_attribute_string($link_key);
                $animate_cls = ' yhsshu-animate yhsshu-invisible animated-normal';
            ?>
                <div class="item-wrap elementor-repeater-item-<?php echo esc_attr($value['_id']); ?>">
                    <div class="item-inner relative">
                        <?php
                            if ($count % 2 == 0) $animation = 'slideInRight';
                            else $animation = 'slideInLeft';

                            $data_animation =  json_encode([
                                'animation'      => $animation,
                                'animation_delay' => 0
                            ]);
                            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
                        ?>
                        <div class="item-info <?php echo esc_attr($animate_cls); ?>" <?php yhsshu_print_html($data_settings); ?>>
                            <?php if (!empty($year)) : ?>
                                <div class="item-year">
                                    <span><?php echo esc_html($year); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($title)) : ?>
                                <div class="item-title">
                                    <?php echo esc_html($title); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($description)) : ?>
                                <div class="item-description">
                                    <?php echo esc_html($description); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="item-dot">
                            <div class="dot-wrapper">
                                <div class="dot"></div>
                            </div>
                        </div>
                        <?php
                            if ($count % 2 == 0) $animation = 'slideInLeft';
                            else $animation = 'slideInRight';
                            $count++;

                            $data_animation =  json_encode([
                                'animation'      => $animation,
                                'animation_delay' => 0
                            ]);
                            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
                        ?>
                        <div class="item-image-wrap <?php echo esc_attr($animate_cls); ?>" <?php yhsshu_print_html($data_settings); ?>>
                            <?php if (!empty($thumbnail1)) : ?>
                                <div class="item-image">
                                    <?php if (!empty($image_link['url'])) echo '<a ' . $link_attributes . '>';
                                    echo wp_kses_post($thumbnail1);
                                    if (!empty($image_link['url'])) echo '</a>';
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>