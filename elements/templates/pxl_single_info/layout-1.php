<?php
$default_settings = [
    'single_info_items' => '',
    'el_title' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = yhsshu_get_element_id($settings);
$info_items = $widget->get_settings('single_info_items');
if(!empty($info_items)) : ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="yhsshu-single-info e-sidebar-widget <?php echo esc_attr($el_style); ?>">
        <?php if(!empty($el_title)) : ?>
            <h3 class="widget-title"><?php echo esc_html($el_title); ?></h3>
        <?php endif; ?>
        <?php foreach ($info_items as $key => $value):
            $info_label = isset($value['info_label']) ? $value['info_label'] : '';
            $info_type = isset($value['info_type']) ? $value['info_type'] : 'text';
            $info_text = isset($value['info_text']) ? $value['info_text'] : '';
            ?>
            <div class="info-item d-flex">
                <div class="inner-text">
                    <span class="label">
                        <?php echo esc_html($info_label); ?>
                    </span>
                    <span class="info-text">
                        <?php
                            switch ($info_type) {
                                case 'text':
                                    echo esc_html($info_text);
                                    break;
                                case 'post_title':
                                    echo esc_attr(get_the_title());
                                    break;
                                case 'post_date':
                                    echo esc_attr(get_the_date());
                                    break;
                                case 'post_categories':
                                    switch(get_post_type()) {
                                        case 'post':
                                            the_terms('', 'category', '', '&nbsp-&nbsp', '');
                                            break;
                                        case 'yhsshu-portfolio':
                                            the_terms('', 'yhsshu-portfolio-category', '', '&nbsp-&nbsp', '');
                                            break;
                                    }
                                    break;
                                case 'post_tags':
                                    switch(get_post_type()) {
                                        case 'post':
                                            $posttags = get_the_tags();
                                            if ($posttags) {
                                                foreach ($posttags as $key => $tag) {
                                                    echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                                    if ($key !== count($posttags) - 1) {
                                                        echo esc_html(' - ', 'yhsshu');
                                                    }
                                                }
                                            };
                                            break;
                                        case 'yhsshu-portfolio':
                                            the_terms('', 'yhsshu-portfolio-tag', '', '&nbsp-&nbsp', '');
                                            break;
                                    }
                                    break;
                            }
                        ?>
                    </span>
                </div>
            </div>
        <?php
        endforeach;?>
        <?php if($show_social) : ?>
            <div class="info-item d-flex">
                <div class="inner-text">
                    <span class="info-text"><?php yhsshu()->blog->get_post_share(); ?></span>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>