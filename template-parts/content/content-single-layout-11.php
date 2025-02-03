<?php

/**
 * Template part for displaying posts in loop
 *
 * @package yhsshu
 */

$audio_url = get_post_meta(get_the_ID(), 'featured-audio-url', true);
$featured_video = get_post_meta(get_the_ID(), 'featured-video-url', true);

if (has_post_thumbnail()) {
    $content_inner_cls = 'single-post-inner has-post-thumbnail';
    $meta_class    = '';
} else {
    $content_inner_cls = 'single-post-inner no-post-thumbnail';
    $meta_class = '';
}

if (class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->documents->get($id)->is_built_with_elementor()) {
    $post_content_classes = 'single-elementor-content';
} else {
    $post_content_classes = '';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('yhsshu-single-post'); ?>>
    <div class="<?php echo esc_attr($content_inner_cls); ?>">
        <?php yhsshu()->blog->get_post_metas_sushi(); ?>
        <?php
        $custom_post_title = yhsshu()->get_theme_opt('single_post_title_layout', '0');
        if ($custom_post_title == '1') : ?>
            <h2 class="post-title">
                <?php echo get_the_title(); ?>
            </h2>
        <?php endif; 
        $post_img = yhsshu()->get_theme_opt('post_feature_image_on', '1');
        ?>
        <?php if (has_post_thumbnail() && esc_attr($post_img) == '1') : ?>
            <div class="post-image post-featured">
                <?php
                yhsshu()->blog->get_post_feature();
                if (!empty($audio_url) && has_post_format('audio')) :
                    $filetype = wp_check_filetype($audio_url)['type'];
                    if ($filetype == 'audio/mpeg') : ?>
                        <div class="yhsshu-media-popup">
                            <div class="content-inner">
                                <a class="media-play-button video-default" href="<?php echo esc_url($audio_url); ?>">
                                    <i class="yhsshui-volume"></i>
                                </a>
                            </div>
                        </div>
                    <?php endif ?>
                <?php elseif (!empty($featured_video) && has_post_format('video')) : ?>
                    <div class="yhsshu-media-popup">
                        <div class="content-inner">
                            <a class="media-play-button video-default" href="<?php echo esc_url($featured_video); ?>">
                                <i class="yhsshui-play-2 yhsshu-icon-outline"></i>
                            </a>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        <?php endif; ?>
        <div class="post-content overflow-hidden">
            <div class="content-inner clearfix <?php echo esc_attr($post_content_classes); ?>">
                <?php the_content(); ?>
            </div>
            <div class="<?php echo trim(implode(' ', ['navigation page-links clearfix empty-none'])); ?>">
                <?php wp_link_pages(); ?>
            </div>
        </div>
        <?php
        $post_tag = yhsshu()->get_theme_opt('post_tag', true);
        $post_social_share = yhsshu()->get_theme_opt('post_social_share', false);
        if ($post_tag == '1' || $post_social_share == '1') {
        ?>
            <div class="post-tags-share d-flex align-items-center">
                <?php
                    if ($post_tag == '1') {
                ?>
                <div class="post-tags-wrap col-sm-7">
                    <i class="yhsshui yhsshui-tag1"></i>
                    <?php yhsshu()->blog->get_post_tags(); ?>
                </div>
                <?php
                }
                if ($post_social_share == '1') { ?>
                    <div class="post-share-wrap col-sm-5">
                        <?php yhsshu()->blog->get_post_share(get_the_ID()); ?>
                    </div>
                <?php 
                } 
                ?>
            </div>
        <?php
        }
        ?>
    </div>
</article>