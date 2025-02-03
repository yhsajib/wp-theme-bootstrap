<?php
$html_id = yhsshu_get_element_id($settings);
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

extract(yhsshu_get_posts_of_grid(
    'post',
    ['source' => $source, 'orderby' => $orderby, 'order' => $order, 'post_ids' => $post_ids],
    $tax
));

$post_type            = $widget->get_setting('post_type', 'post');
$layout               = $widget->get_setting('layout_' . $post_type, 'post-create-1');
$layout_mode          = $widget->get_setting('layout_mode', 'fitRows');

if (count($posts) <= 0) {
    echo '<div class="yhsshu-no-post-grid">' . esc_html__('No Post Found', 'yhsshu') . '</div>';
    return;
}
extract($settings);
?>

<div class="yhsshu-post-create layout-1">
    <div class="post-imgs"></div>
    <div class="container d-flex justify-content-between">
        <div class="post-list-container">
            <?php foreach ($posts as $key => $post) :
                if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                    $img_id = get_post_thumbnail_id($post->ID);
                    if ($img_id) {
                        $img = yhsshu_get_image_by_size(array(
                            'attach_id'  => $img_id,
                            'thumb_size' => 'full',
                            'class' => 'no-lazyload'
                        ));
                        $thumbnail = $img['thumbnail'];
                    } else {
                        $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                    }
                }
                $button_text = !empty($button_text) ? $button_text : esc_html__('Read more', 'yhsshu');
                $increase = $key + 1;

                if (!empty($args_m[$key]['data_setting']))
                    $data_settings = $args_m[$key]['data_setting'];
                $author = get_user_by('id', $post->post_author);
            ?>
                <div class="item-inner">
                    <?php
                    if (isset($thumbnail)) { ?>
                        <div class="item-featured">
                            <div id="<?php echo 'itembg-' . esc_attr($key); ?>" class="post-image">
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="item-content">
                        <?php
                        $featured_video = get_post_meta($post->ID, 'featured-video-url', true);
                        $audio_url = get_post_meta($post->ID, 'featured-audio-url', true);
                        if (has_post_format('video', $post->ID) && !empty($featured_video)) : ?>
                            <div class="video-btn d-none">
                                <a href="<?php echo esc_url($featured_video); ?>">
                                    <?php echo esc_html('Watch video', 'yhsshu'); ?>
                                </a>
                            </div>
                        <?php endif;
                        if (has_post_format('audio', $post->ID) && !empty($audio_url)) : ?>
                            <div class="audio-btn d-none">
                                <a href="<?php echo esc_url($audio_url); ?>">
                                    <?php echo esc_html('Listen audio', 'yhsshu'); ?>
                                </a>
                            </div>
                        <?php endif;
                        if ($show_date == 'true') : ?>
                            <div class="item-date d-none">
                                <?php echo get_the_date('', $post->ID); ?>
                            </div>
                        <?php endif; ?>
                        <h3 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h3>
                        <?php if ($show_excerpt == 'true') : ?>
                            <div class="item-excerpt d-none">
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
                            <div class="item-readmore yhsshu-button-wrapper d-none">
                                <a class="btn-more" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                    <span><?php echo yhsshu_print_html($button_text); ?></span>
                                    <i class="zmdi zmdi-long-arrow-right"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php
                        if ($show_author == 'true' || $show_comment == 'true') { ?>
                            <div class="item-metas d-none">
                                <div class="meta-inner">
                                    <?php if ($show_author == 'true') : ?>
                                        <span class="post-author">
                                            <span class="label"><?php echo esc_html__('Written By', 'yhsshu'); ?>&nbsp;<a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>"><?php echo esc_html($author->display_name); ?></a></span>
                                        </span>
                                    <?php endif; ?>
                                    <?php if ($show_comment == 'true') : ?>
                                        <span class="post-comments">
                                            <a href="<?php echo get_comments_link($post->ID); ?>">
                                                <span><?php comments_number(esc_html__('No Comments', 'yhsshu'), esc_html__(' 1 Comment', 'yhsshu'), esc_html__(' % Comments', 'yhsshu'), $post->ID); ?></span>
                                            </a>
                                        </span>
                                    <?php endif; ?>
                                    <?php if ($show_category == 'true') : ?>
                                        <span class="post-category">
                                            <?php the_terms($post->ID, 'category', '', ', ', ''); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            endforeach; ?>
        </div>
        <div class="item-content-large">
            <div class="d-flex align-items-center">
                <div class="post-date"></div>
                <div class="post-media"></div>
            </div>
            <div class="post-title"></div>
            <div class="post-metas"></div>
            <div class="yhsshu-divider"></div>
            <div class="post-excerpt"></div>
            <div class="post-readmore"></div>
        </div>
        <div class="scroll-bar animation">
            <span><?php echo esc_html('Scroll', 'yhsshu') ?></span>
            <div class="scroll-icon">
                <i class="yhsshui yhsshui-down-arrow"></i>
            </div>
        </div>
    </div>
</div>