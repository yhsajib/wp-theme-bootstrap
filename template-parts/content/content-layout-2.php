<?php

/**
 * @package yhsshu
 */

$archive_readmore = yhsshu()->get_theme_opt('archive_readmore', '0');
$archive_readmore_text = yhsshu()->get_theme_opt('archive_readmore_text', esc_html__('Continue reading', 'yhsshu'));
$post_social_share = yhsshu()->get_theme_opt('post_social_share', false);
$featured_video = get_post_meta(get_the_ID(), 'featured-video-url', true);
$audio_url = get_post_meta(get_the_ID(), 'featured-audio-url', true);

$theme_style = yhsshu()->get_theme_opt('theme_style', 'default');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array('yhsshu-archive-post', $theme_style)); ?>>
    <?php if (has_post_thumbnail()) { ?>
        <div class="post-featured">
            <?php
            if (has_post_format('quote')) {
                $quote_text = get_post_meta(get_the_ID(), 'featured-quote-text', true);
                $quote_cite = get_post_meta(get_the_ID(), 'featured-quote-cite', true);
            ?>
                <div class="format-wrap">
                    <div class="quote-inner">
                        <div class="quote-icon">
                            <span>“</span>
                        </div>
                        <div class="quote-text">
                            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html($quote_text); ?></a>
                        </div>
                        <div class="yhsshu-divider"></div>
                        <?php
                        if (!empty($quote_cite)) {
                        ?>
                            <p class="quote-cite">
                                <?php echo esc_html($quote_cite); ?>
                            </p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            } elseif (has_post_format('link')) {
                $link_url = get_post_meta(get_the_ID(), 'featured-link-url', true);
                $link_text = get_post_meta(get_the_ID(), 'featured-link-text', true);
                $link_cite = get_post_meta(get_the_ID(), 'featured-link-cite', true);
            ?>
                <div class="format-wrap">
                    <div class="link-inner">
                        <div class="link-icon">
                            <a href="<?php echo esc_url($link_url); ?>"><span class="yhsshui-link"></span></a>
                        </div>
                        <a class="link-text" target="_blank" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_text); ?></a>
                        <?php if (!empty($link_cite)) : ?>
                            <div class="yhsshu-divider"></div>
                            <p class="link-cite">
                                <?php echo esc_attr($link_cite); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            } elseif (has_post_format('video')) {
                if (has_post_thumbnail()) {
                ?>
                    <div class="post-image">
                        <a href="<?php echo esc_url(get_permalink()); ?>">
                            <?php yhsshu()->blog->get_post_feature(); ?>
                        </a>
                    </div>
                    <?php
                    if (!empty($featured_video)) {
                    ?>
                        <div class="yhsshu-media-popup">
                            <div class="content-inner">
                                <a class="media-play-button media-default" href="<?php echo esc_url($featured_video); ?>">
                                    <i class="yhsshui-play-2 yhsshu-icon-outline"></i>
                                </a>
                            </div>
                        </div>
                    <?php
                    }
                }
            } elseif (has_post_format('audio')) {
                if (has_post_thumbnail()) { ?>
                    <div class="post-image">
                        <a href="<?php echo esc_url(get_permalink()); ?>">
                            <?php yhsshu()->blog->get_post_feature(); ?>
                        </a>
                    </div>
                    <?php }
                if (!empty($audio_url)) {
                    $filetype = wp_check_filetype($audio_url)['type'];
                    if ($filetype == 'audio/mpeg') { ?>
                        <div class="yhsshu-media-popup">
                            <div class="content-inner">
                                <a class="media-play-button media-default" href="<?php echo esc_url($audio_url); ?>">
                                    <i class="yhsshui-volume"></i>
                                </a>
                            </div>
                        </div>
                <?php }
                } else {
                    global $wp_embed;
                    yhsshu_print_html($wp_embed->run_shortcode('[embed]' . $audio_url . '[/embed]'));
                }
            } else {
                ?>
                <div class="post-image">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <?php yhsshu()->blog->get_post_feature(); ?>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    <?php } ?>
    <?php
    if (!has_post_format('link') && !has_post_format('quote')) {
    ?>
        <div class="post-content">
            <?php yhsshu()->blog->get_archive_meta_luxury(); ?>
            <h2 class="post-title">
                <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                    <?php if (is_sticky()) { ?>
                        <i class="yhsshui-thumbtack"></i>
                    <?php } ?>
                    <?php the_title(); ?>
                </a>
            </h2>
            <div class="yhsshu-post-divider"></div>
            <div class="post-excerpt">
                <?php
                yhsshu()->blog->get_excerpt(40);
                wp_link_pages(array(
                    'before'      => '<div class="page-links">',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ));
                ?>
            </div>
            <?php if ($archive_readmore == '1') : ?>
                <div class="button-share d-flex align-items-center">
                    <?php
                    if ($archive_readmore == '1') {
                    ?>
                        <div class="post-btn-wrap col-sm-6">
                            <a class="btn-more style-2" href="<?php echo esc_url(get_permalink()); ?>">
                                <span><?php echo esc_html($archive_readmore_text); ?></span>
                                <i class="zmdi zmdi-long-arrow-right"></i>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>
    <?php
    }
    ?>
</article>