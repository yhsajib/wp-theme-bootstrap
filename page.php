<?php
/**
 * @package yhsshu
 */
get_header();
$yhsshu_sidebar = yhsshu()->get_sidebar_args(['type' => 'page', 'content_col'=> '8']); // type: blog, post, page, shop, product

if(class_exists('\Elementor\Plugin')){
    $id = get_the_ID();
    if ( is_singular() && \Elementor\Plugin::$instance->documents->get( $id )->is_built_with_elementor()) {
        $classes = 'elementor-container yhsshu-page-content';
    } else {
        $classes = 'container';
    }
} else {
    $classes = 'container';
}

if ($yhsshu_sidebar['sidebar_class']) $classes = 'container';
?>
<div class="<?php echo esc_attr($classes);?> yhsshu-content-container">
    <div class="row <?php echo esc_attr($yhsshu_sidebar['wrap_class']) ?>">
        <div id="yhsshu-content-area" class="<?php echo esc_attr($yhsshu_sidebar['content_class']) ?>">
            <main id="yhsshu-content-main" class="yhsshu-content-main">
                <?php while ( have_posts() ) {
                    the_post();
                    get_template_part( 'template-parts/content/content', 'page' );
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                } ?>
            </main>
        </div>
        <?php if ($yhsshu_sidebar['sidebar_class']) : ?>
            <div id="yhsshu-sidebar-area" class="<?php echo esc_attr($yhsshu_sidebar['sidebar_class']) ?>">
                <div class="sidebar-sticky-wrap">
                    <?php dynamic_sidebar( 'sidebar-page' ); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php get_footer();