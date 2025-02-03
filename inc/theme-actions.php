<?php 
/**
 * Actions Hook for the theme
 *
 * @package yhsshu
 */
 
add_action('after_setup_theme', 'yhsshu_setup');
function yhsshu_setup(){
    //Set the content width in pixels, based on the theme's design and stylesheet.
    $GLOBALS['content_width'] = apply_filters( 'yhsshu_content_width', 1200 );

    // Make theme available for translation.
    load_theme_textdomain( 'yhsshu', get_template_directory() . '/languages' );

    // Custom Header
    add_theme_support( 'custom-header' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Set post thumbnail size.
    set_post_thumbnail_size( 1170, 560 );
    $custom_sizes = yhsshu_configs('custom_sizes'); 
    foreach ($custom_sizes as $option => $values) {
        add_image_size( $option, $values[0], $values[1], $values[2] );
    }
   
    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'yhsshu' ),
    ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for core custom logo.
    add_theme_support( 'custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ) );
    // Post formats
    add_theme_support( 'post-formats', array(
        'video',
        'audio',
        'quote',
        'link',
    ) );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    remove_theme_support('widgets-block-editor');

}

/**
 * Register Widgets Position.
 */
add_action( 'widgets_init', 'yhsshu_widgets_position' );
function yhsshu_widgets_position() {
    register_sidebar( array(
        'name'          => esc_html__( 'Blog Sidebar', 'yhsshu' ),
        'id'            => 'sidebar-blog',
        'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<h3 class="widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
     
    if (class_exists('ReduxFramework') && class_exists('yhsshutheme_Core')) {
        register_sidebar( array(
            'name'          => esc_html__( 'Page Sidebar', 'yhsshu' ),
            'id'            => 'sidebar-page',
            'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
            'after_widget'  => '</div></section>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>',
        ) );
    }

    if ( class_exists( 'Woocommerce' ) ) {
        register_sidebar( array(
            'name'          => esc_html__( 'Shop Sidebar', 'yhsshu' ),
            'id'            => 'sidebar-shop',
            'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
            'after_widget'  => '</div></section>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>',
        ) );
    }
}

/**
 * Enqueue Styles Scripts : Front-End
 */
add_action( 'wp_enqueue_scripts', 'yhsshu_scripts' );
function yhsshu_scripts() {
    $js_variables = array(
        'ajaxurl'          => admin_url( 'admin-ajax.php' ),
        'yhsshu_ajax_url'     => class_exists('yhsshu_Ajax') ? yhsshu_Ajax::get_endpoint( '%%endpoint%%' ) : '#',
        'variation_alert'  => esc_html__( 'Please select some product options before add to cart or buy now', 'yhsshu' ),
        'is_single'                  => is_singular(),
        'post_id'                    => is_singular() ? get_the_ID() : 0,
        'post_type'                  => get_post_type(),
        'nonce'                      => wp_create_nonce( 'yhsshu-security' ),
        'apply_coupon_nonce'         => wp_create_nonce( 'apply-coupon' ),
        'is_checkout_page'           => class_exists('Woocommerce') ? is_checkout() : '',
        'i18l'                      => [
            'no_matched_found' => esc_html( _x( 'No matched found', 'enhanced select', 'yhsshu' ) ),
            'all'            => esc_html__( 'All %s', 'yhsshu' ),
        ],
    );

    /* Icons Lib */
    wp_enqueue_style( 'yhsshu-icon', get_template_directory_uri() . '/assets/fonts/pixelart/style.css', array(), yhsshu()->get_version());
    wp_enqueue_style( 'material', get_template_directory_uri() . '/assets/fonts/material/css/font-material.min.css', array(), '1.0.0');
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.0.0' );
    wp_enqueue_style( 'yhsshu-grid', get_template_directory_uri() . '/assets/css/grid.css', array(), yhsshu()->get_version() );
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.8.1' );
    wp_enqueue_style( 'yhsshu-style', get_template_directory_uri() . '/assets/css/style.css', array(), yhsshu()->get_version() );
    wp_add_inline_style( 'yhsshu-style', yhsshu_inline_styles() );
    wp_enqueue_style( 'yhsshu-base', get_template_directory_uri() . '/style.css', array(), yhsshu()->get_version() );
    wp_enqueue_style( 'yhsshu-google-fonts', yhsshu_fonts_url(), array(), null );

    wp_enqueue_script( 'gsap', get_template_directory_uri() . '/assets/js/gsap.min.js', array( 'jquery' ), yhsshu()->get_version(), true );
    wp_enqueue_script( 'ScrollTrigger', get_template_directory_uri() . '/assets/js/ScrollTrigger.min.js', array( 'jquery' ), yhsshu()->get_version(), true );
    wp_enqueue_script( 'tilt', get_template_directory_uri() . '/assets/js/tilt.jquery.min.js', array( 'jquery' ), yhsshu()->get_version(), true );
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.8.1', true);
    wp_enqueue_script('nice-select', get_template_directory_uri() . '/assets/js/nice-select.min.js', array('jquery'), '1.1.0', true);
    wp_enqueue_script( 'circletype', get_template_directory_uri() . '/assets/js/circletype.min.js', array( 'jquery' ), '2.3.2', true );
    wp_enqueue_script( 'yhsshu-main', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), yhsshu()->get_version(), true );
    wp_localize_script( 'yhsshu-main', 'main_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    $smoothscroll = yhsshu()->get_theme_opt( 'smoothscroll', false );
    if(isset($smoothscroll) && $smoothscroll) {
        wp_enqueue_script('yhsshu-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('jquery'), '1.0.0', true);
    }

    if ( !wp_script_is( 'swiper', 'registered' )) {
        wp_register_script('swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', [], '10.3.0');
    }
    
    wp_register_script('yhsshu-swiper', get_template_directory_uri() . '/elements/assets/js/yhsshu-swiper-carousel.js', ['jquery'], yhsshu()->get_version(), true);
    wp_localize_script( 'yhsshu-main', 'main_data', $js_variables );
    do_action( 'yhsshu_scripts');
}

/**
 * Enqueue Styles Scripts : Back-End
 */
add_action('admin_enqueue_scripts', 'yhsshu_admin_style');
function yhsshu_admin_style() {
    wp_enqueue_style('yhsshu-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), '1.0.0');
    wp_enqueue_style('yhsshu-icon', get_template_directory_uri() . '/assets/fonts/pixelart/style.css', array(), '1.0.0');
    wp_enqueue_style('material', get_template_directory_uri() . '/assets/fonts/material/css/font-material.min.css', array(), '1.0.0');
    wp_enqueue_script( 'admin-widget', get_template_directory_uri() . '/inc/admin/assets/js/widget.js', array( 'jquery' ), array( 'jquery' ), '1.0.0', true );
}

add_action( 'elementor/editor/before_enqueue_scripts', function() {
    wp_enqueue_style( 'yhsshu-custom-editor', get_template_directory_uri() . '/assets/css/custom-editor.css', array(), '1.0.0' );
    wp_enqueue_style( 'admin-yhsshu-icon', get_template_directory_uri() . '/assets/fonts/pixelart/style.css', array(), '1.0.0' );
    wp_enqueue_style( 'admin-material', get_template_directory_uri() . '/assets/fonts/material/css/font-material.min.css', array(), '1.0.0' );
} );

//* Favicon
add_action('wp_head', 'yhsshu_site_favicon');
function yhsshu_site_favicon(){
    $favicon = yhsshu()->get_theme_opt( 'favicon' );
    if(!empty($favicon['url']))
        echo '<link rel="icon" type="image/png" href="'.esc_url($favicon['url']).'"/>';
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
add_action( 'wp_head', 'yhsshu_pingback_header' );
function yhsshu_pingback_header(){
    if ( is_singular() && pings_open() )
    {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}

add_action( 'elementor/preview/enqueue_styles', 'yhsshu_add_editor_preview_style' );
function yhsshu_add_editor_preview_style(){
    wp_add_inline_style( 'editor-preview', yhsshu_editor_preview_inline_styles() );
}
function yhsshu_editor_preview_inline_styles(){
    $theme_colors = yhsshu_configs('theme_colors');
    ob_start();
        echo '.elementor-edit-area-active{';
            foreach ($theme_colors as $color => $value) {
                printf('--%1$s-color: %2$s;', str_replace('#', '',$color),  $value['value']);
            }
        echo '}';
    return ob_get_clean();
}

/**
 * Add field subtitle to post.
 */
add_action( 'edit_form_after_title', 'yhsshu_add_subtitle_field' );
function yhsshu_add_subtitle_field() {
    global $post;

    $screen = get_current_screen();

    if ( in_array( $screen->id, array( 'acm-post' ) ) ) {

        $value = get_post_meta( $post->ID, 'post_subtitle', true );

        echo '<div class="subtitle"><input type="text" name="post_subtitle" value="' . esc_attr( $value ) . '" id="subtitle" placeholder = "' . esc_attr__( 'Subtitle', 'yhsshu' ) . '" style="width: 100%;margin-top: 4px;"></div>';
    }
}

add_action('wp_footer', 'yhsshu_backtotop', 2);
function yhsshu_backtotop($args = []){
    $back_totop_on = yhsshu()->get_theme_opt('back_totop_on', true);
    $back_totop_on_style = yhsshu()->get_theme_opt('back_totop_on_style', 'default');
    if ('1' !== $back_totop_on) return;
    $class = 'yhsshu-scroll-top';
    if ($back_totop_on_style === 'sushi') {
        $class .= ' sushi';
    }
    if ($back_totop_on_style === 'custom-style-1') {
        $class .= ' custom-style-1';
    }
    if ($back_totop_on_style === 'custom-style-2') {
        $class .= ' custom-style-2';
    }
    ?>
    <a href="javascript:void(0);" class="<?php echo esc_attr($class); ?>">
        <?php if ($back_totop_on_style === 'sushi') : ?>
            <svg class="yhsshu-scroll-progress-circle" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
            </svg>
            <i class="yhsshui yhsshui-angle-up"></i>
        <?php endif; ?>
        <?php if ($back_totop_on_style === 'custom-style-1') : ?>
            <svg class="yhsshu-scroll-progress-circle" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
            </svg>
            <i class="yhsshui yhsshui-angle-up"></i>
        <?php endif; ?>
        <?php if ($back_totop_on_style === 'custom-style-2') : ?>
            <svg class="yhsshu-scroll-progress-circle" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
            </svg>
            <i class="yhsshui yhsshui-angle-up"></i>
        <?php endif; ?>
        <?php if ($back_totop_on_style === 'default') : ?>
            <i class="zmdi zmdi-long-arrow-up"></i>
        <?php endif; ?>
    </a>
    <?php 
}

add_action( 'yhsshutheme_anchor_target', 'yhsshu_hook_anchor_side_mobile_default');
function yhsshu_hook_anchor_side_mobile_default(){
    $header_mobile_layout = (int)yhsshu()->get_opt('header_mobile_layout'); 
    if( $header_mobile_layout > 0 ) return;
    ?>
    <nav class="yhsshu-hidden-template pos-left yhsshu-side-mobile df">
        <div class="yhsshu-panel-header">
            <div class="panel-header-inner">
                <a href="#" class="yhsshu-close" data-target=".yhsshu-side-mobile" title="<?php echo esc_attr__( 'Close', 'yhsshu' ) ?>">
                    <i class="yhsshui yhsshui-remove1"></i>
                </a>
            </div>
        </div> 
        <div class="yhsshu-panel-content custom_scroll">
            <div class="menu-main-container-wrap">
                <div id="mobile-menu-container" class="menu-main-container">
                    <?php 
                        if ( has_nav_menu( 'primary' ) ){
                            wp_nav_menu( 
                                array(
                                    'theme_location' => 'primary',
                                    'container'      => '',
                                    'menu_id'        => 'yhsshu-mobile-menu',
                                    'menu_class'     => 'yhsshu-mobile-menu clearfix',
                                    'link_before'    => '<span class="yhsshu-menu-title">',
                                    'link_after'     => '</span>',  
                                    'walker'         => '',
                                ) 
                            );
                        }else{
                            printf(
                                '<ul class="yhsshu-mobile-menu yhsshu-primary-menu primary-menu-not-set"><li><a href="%1$s">%2$s</a></li></ul>',
                                esc_url( admin_url( 'nav-menus.php' ) ),
                                esc_html__( 'Create New Menu', 'yhsshu' )
                            );
                        }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <?php 
}

add_action( 'yhsshutheme_anchor_target', 'yhsshu_hook_anchor_templates_hidden_panel');
function yhsshu_hook_anchor_templates_hidden_panel(){

    $hidden_templates = yhsshu_get_templates_slug('hidden-panel');
    if(empty($hidden_templates)) return;
    foreach ($hidden_templates as $slug => $values){
        $args = [
            'slug' => $slug,
            'post_id' => $values['post_id'],
            'position' => !empty($values['position']) ? $values['position'] : 'custom-pos'
        ];
        if (did_action('yhsshu_anchor_target_hidden_panel_'.$values['post_id']) <= 0){
            do_action( 'yhsshu_anchor_target_hidden_panel_'.$values['post_id'], $args );
        }
    }
}

function yhsshu_hook_anchor_hidden_panel($args){
    if (get_post_meta($args['post_id'], 'template_close_select', true) == 'custom')
        $close_btn_style = get_post_meta($args['post_id'], 'template_close_style', true);
    else if (get_post_meta($args['post_id'], 'template_close_select', true) == 'none')
        $close_btn_style = 'none';
    else
        $close_btn_style = yhsshu()->get_theme_opt('template_close_button', 'style-df');

    $custom_cls = get_post_meta($args['post_id'], 'custom_cls', true);
    ?>
    <div class="yhsshu-hidden-template yhsshu-hidden-template-<?php echo esc_attr($args['post_id'])?> pos-<?php echo esc_attr($args['position']) ?> <?php echo esc_attr($custom_cls); ?>">
        <div class="yhsshu-hidden-template-wrap">
            <div class="yhsshu-panel-content custom_scroll">
                <span class="yhsshu-close <?php echo esc_attr($close_btn_style); ?>" title="Close"></span>
               <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$args['post_id']); ?>
            </div>
        </div>
    </div>
    <?php
}

function yhsshu_hook_anchor_custom(){
    return;
}

add_action( 'yhsshutheme_anchor_target', 'yhsshu_output_popup' );
function yhsshu_output_popup(){
    $enable_popup = yhsshu()->get_page_opt('enable_popup', 'off');
    $close_btn_style = yhsshu()->get_theme_opt('template_close_button', 'style-df');
    if ($enable_popup == 'on'){
        $popup_template = (int)yhsshu()->get_page_opt('popup_template', '');
        ?>
        <?php if ($popup_template > 0): 
            $template_position = get_post_meta( $popup_newsletter_template, 'template_position', true);
            $template_custom_style = get_post_meta( $popup_newsletter_template, 'template_custom_style', true );
            $popup_nsl_times = (int)yhsshu()->get_theme_opt('popup_nsl_times', '1');
            $popup_nsl_time_out = (int)yhsshu()->get_theme_opt('popup_nsl_time_out', '1000');
            ?>
            <div class="yhsshu-hidden-template page-popup yhsshu-hidden-template-<?php echo esc_attr($popup_newsletter_template)?> el-builder pos-<?php echo esc_attr($template_position) ?> <?php echo esc_attr($template_custom_style) ?>" data-nsl_times = "<?php echo esc_attr($popup_nsl_times) ?>" data-nsl_time_out = "<?php echo esc_attr($popup_nsl_time_out) ?>">
                <div class="yhsshu-hidden-template-wrap">
                    <div class="yhsshu-panel-content custom_scroll">
                        <span class="yhsshu-close <?php echo esc_attr($close_btn_style); ?>" title="Close">x</span>
                       <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $popup_newsletter_template); ?>
                    </div>
                </div>
            </div> 
        <?php endif; ?>
        <?php 
    }
}

add_action( 'yhsshutheme_anchor_target', 'yhsshu_header_popup_cart');
function yhsshu_header_popup_cart(){  
    if(!class_exists('Woocommerce')) return;
    $close_btn_style = yhsshu()->get_theme_opt('template_close_button', 'style-df');
    ?>
    <div class="yhsshu-hidden-template yhsshu-side-cart">
        <div class="yhsshu-hidden-template-wrap">
            <div class="yhsshu-panel-header">
                <div class="panel-header-inner">
                    <a href="#" class="yhsshu-close <?php echo esc_attr($close_btn_style); ?>" title="<?php echo esc_attr__( 'Close', 'yhsshu' ) ?>"></a>
                </div>
            </div>
            <div class="yhsshu-side-panel-content widget_shopping_cart custom_scroll">
                <div class="cart-title">
                    <h3><?php echo esc_html__( 'Shopping Cart', 'yhsshu' ) ?></h3>
                </div>
                <div class="widget_shopping_cart_content">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

//* Custom archive link
function yhsshu_custom_archive_post_type_link() {
    $yhsshu_portfolio_archive_link = yhsshu()->get_theme_opt('yhsshu_portfolio_archive_link', '');
    $yhsshu_service_archive_link = yhsshu()->get_theme_opt('yhsshu_service_archive_link', '');
    $yhsshu_food_archive_link = yhsshu()->get_theme_opt('yhsshu_food_archive_link', '');
    if( is_post_type_archive( 'yhsshu-portfolio' ) && !empty($yhsshu_portfolio_archive_link) ) {
        wp_redirect( $yhsshu_portfolio_archive_link, 301 );
        exit();
    }
    if( is_post_type_archive( 'yhsshu-service' ) && !empty($yhsshu_service_archive_link) ) {
        wp_redirect( $yhsshu_service_archive_link, 301 );
        exit();
    }
    if( is_post_type_archive( 'yhsshu-food' ) && !empty($yhsshu_food_archive_link) ) {
        wp_redirect( $yhsshu_food_archive_link, 301 );
        exit();
    }
}
add_action( 'template_redirect', 'yhsshu_custom_archive_post_type_link' );