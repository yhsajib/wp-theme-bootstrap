<?php
extract($settings);

$tax = ['category'];
$select_post_by = $widget->get_setting('select_post_by', 'term_selected');
$source = $post_ids = [];

if ($select_post_by === 'post_selected') {
    $post_ids = $widget->get_setting('source_' . $settings['post_type'] . '_post_ids', '');
} else {
    $source  = $widget->get_setting('source_' . $settings['post_type'], '');
}

$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', -1);
$num_words = $widget->get_setting('num_words', 19);
$settings['layout']    = $settings['layout_' . $settings['post_type']];

$tab_style = yhsshu()->get_theme_opt('tab_style', 'style-df');

extract(yhsshu_get_posts_of_grid(
    'post',
    ['source' => $source, 'orderby' => $orderby, 'order' => $order, 'limit' => $limit, 'post_ids' => $post_ids],
    $tax
));

$arrows_style = $widget->get_setting('arrows_style', 'style-1');

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1,
    'slide_mode'                    => 'slide',
    'slides_to_show_xxl'            => (float)$widget->get_setting('col_xxl', 4),
    'slides_to_show'                => (float)$widget->get_setting('col_xl', 4),
    'slides_to_show_lg'             => (float)$widget->get_setting('col_lg', 3),
    'slides_to_show_md'             => (float)$widget->get_setting('col_md', 3),
    'slides_to_show_sm'             => (float)$widget->get_setting('col_sm', 2),
    'slides_to_show_xs'             => (float)$widget->get_setting('col_xs', 1),
    'slides_to_scroll'              => (int)$widget->get_setting('slides_to_scroll', 1),
    'slides_gutter'                 => (int)$gutter,
    'center_slide'                  => (bool)$widget->get_setting('center_slide', false),
    'arrow'                         => true,
    'dots'                          => true,
    'dots_style'                    => 'bullets',
    'autoplay'                      => (bool)$widget->get_setting('autoplay', false),
    'pause_on_hover'                => (bool)$widget->get_setting('pause_on_hover', false),
    'pause_on_interaction'          => true,
    'delay'                         => (int)$widget->get_setting('autoplay_speed', 5000),
    'loop'                          => (bool)$widget->get_setting('infinite', false),
    'speed'                         => (int)$widget->get_setting('speed', 500)
];


$img_size = !empty($img_size) ? $img_size : '600x800';
$widget->add_render_attribute('carousel', [
    'class'         => 'yhsshu-swiper-container overflow-hidden',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);

$button_text = !empty($button_text) ? $button_text : esc_html__('READ MORE', 'yhsshu');
?>
<?php if (!empty($posts) && count($posts)) : ?>

<div class="yhsshu-swiper-slider yhsshu-post-carousel layout-<?php echo esc_attr($settings['layout']); ?> center-mode-<?php echo esc_attr($opts['center_slide']); ?>">
    <?php if ($select_post_by === 'term_selected' && $filter == "true") : ?>
        <div class="swiper-filter-wrap <?php echo esc_attr($tab_style); ?>">
            <?php if (!empty($filter_default_title)) : ?>
                <span class="filter-item active" data-filter-target="all"><?php echo esc_html($filter_default_title); ?></span>
            <?php endif; ?>
            <?php foreach ($categories as $category) :
                $category_arr = explode('|', $category);
                $term = get_term_by('slug', $category_arr[0], $category_arr[1]);
                ?>
                <span class="filter-item" data-filter-target="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="yhsshu-swiper-slider-wrap yhsshu-carousel-inner realative">
        <div <?php yhsshu_print_html($widget->get_render_attribute_string('carousel')); ?>>
            <div class="yhsshu-swiper-wrapper swiper-wrapper">
                <?php
                $i = 0;
                foreach ($posts as $post) :
                    $i = $i + 50;
                    $thumbnail = '';
                    if (has_post_thumbnail($post->ID)) {
                        $img = yhsshu_get_image_by_size(array(
                            'post_id'  => $post->ID,
                            'thumb_size' => $img_size,
                            'class' => 'no-lazyload',
                        ));
                        $thumbnail = $img['thumbnail'];
                    }
                    $filter_class = '';
                    if ($select_post_by === 'term_selected' && $filter == "true")
                        $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));

                    $author = get_user_by('id', $post->post_author);
                    ?>
                    <div class="yhsshu-swiper-slide swiper-slide" data-filter="<?php echo esc_attr($filter_class) ?>">
                        <?php if (isset($thumbnail)) : ?>
                            <div class="item-featured">
                                <div class="post-image scale-hover-x-right">
                                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </a>
                                </div>
                                <?php if ( $show_date == 'true') : ?>
                                    <?php
                                    if ($show_date == 'true') : ?>
                                        <div class="post-date d-flex align-items-center">
                                            <div class="box-day"> 
                                                <?php echo get_the_date('d', $post->ID);?>
                                            </div>
                                            <div class="month-year">
                                                <div class="date-month"> 
                                                    <?php echo get_the_date('M', $post->ID);?>
                                                </div>
                                                <div class="date-year"> 
                                                    <?php echo get_the_date('y', $post->ID);?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="item-content">
                            <?php if ($show_category == 'true' || $show_author == 'true') : ?>
                                <div class="post-metas hover-underline">
                                    <div class="meta-inner d-flex">
                                        <?php if ($show_author == 'true') : ?>
                                            <span class="post-author">
                                                <span class="label"><?php echo esc_html__('By', 'yhsshu'); ?></span>
                                                <a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>"><?php echo esc_html($author->display_name); ?></a>
                                            </span>
                                        <?php endif; ?>
                                        <?php if ($show_category == 'true') : ?>
                                            <span class="post-category">
                                                <span><?php the_terms($post->ID, 'category', '', ', ', ''); ?></span>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <h4 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h4>
                            <?php if ($show_excerpt == 'true') : ?>
                                <div class="item-excerpt">
                                    <?php
                                    if (!empty($post->post_excerpt)) {
                                        echo wp_trim_words($post->post_excerpt, $num_words, null);
                                    } else {
                                        $content = strip_shortcodes($post->post_content);
                                        $content = apply_filters('the_content', $content);
                                        $content = str_replace(']]>', ']]&gt;', $content);
                                        echo wp_trim_words($content, $num_words, null);
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($show_button == 'true') : ?>
                                <div class="item-readmore yhsshu-button-wrapper">
                                    <a class="btn-more style-3" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                        <span><?php echo yhsshu_print_html($button_text); ?></span>
                                        <i class="yhsshui yhsshui-angle-right1"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php yhsshu_arrow_template($settings); ?>
        <div class="yhsshu-swiper-dots"></div>
    </div>
</div>
<?php endif; ?>