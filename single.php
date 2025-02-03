<?php
/**
 * @package yhsshu
 */
get_header();

$theme_post_style = yhsshu()->get_theme_opt('single_post_layout', 'layout-1');
$page_post_style  = yhsshu()->get_page_opt('single_post_layout', '-1');
$post_style = esc_attr($page_post_style) == '-1' ? $theme_post_style : $page_post_style;

$yhsshu_sidebar = yhsshu()->get_sidebar_args(['type' => 'post', 'content_col' => '8']); // type: blog, post, page, shop, product
?>
    <div class="container">
        <div class="row <?php echo esc_attr($yhsshu_sidebar['wrap_class']) ?>">
            <div id="yhsshu-content-area" class="<?php echo esc_attr($yhsshu_sidebar['content_class']) ?>">
                <main id="yhsshu-content-main" class="yhsshu-content-main <?php echo esc_attr($post_style); ?> <?php echo esc_attr($yhsshu_sidebar['sidebar_class']) ? '' : 'no-sidebar' ;?>">
                    <?php while (have_posts()) {
                        the_post();
                        get_template_part( 'template-parts/content/content-single-'.$post_style, get_post_format());
                        if (comments_open() || get_comments_number()) {
                            comments_template();
                        }
                    } ?>
                </main>
            </div>
            <?php if ($yhsshu_sidebar['sidebar_class']) : ?>
                <div id="yhsshu-sidebar-area" class="<?php echo esc_attr($yhsshu_sidebar['sidebar_class']) ?>">
                    <div class="sidebar-sticky-wrap">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer();
