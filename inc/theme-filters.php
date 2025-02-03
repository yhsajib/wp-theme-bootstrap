<?php
/**
 * Filters hook for the theme
 *
 * @package yhsshu
 */

add_filter( 'yhsshu_server_info', 'yhsshu_add_server_info');
function yhsshu_add_server_info($infos){
    $infos = [
        'api_url' => 'https://api.7iquid.com/',
        'docs_url' => 'https://doc.7iquid.com/yhsshu/',
        'plugin_url' => 'https://7iquid.com/plugins/',
        'demo_url' => 'https://demo.7iquid.com/yhsshu/main/',
        'support_url' => '#',
        'help_url' => '#',
        'email_support' => '7iquid.agency@gmail.com',
        'video_url' => '#'
    ];

    return $infos;
}

//* Change Register Folder
add_filter('yhsshu-register-widgets-folder','yhsshu_custom_register_folder');
function yhsshu_custom_register_folder($folder_path){
    return get_template_directory() . '/elements/register/';
}

//* Post Type Support Elementor
add_filter( 'yhsshu_add_cpt_support', 'yhsshu_add_cpt_support' );
function yhsshu_add_cpt_support($cpt_support) {
    $cpt_support[] = 'yhsshu-portfolio';
    $cpt_support[] = 'yhsshu-service';
    $cpt_support[] = 'yhsshu-food';
    return $cpt_support;
}


add_filter( 'yhsshu_extra_post_types', 'yhsshu_add_post_type' );
function yhsshu_add_post_type( $postypes ) {
    $postypes['portfolio'] = array(
        'status' => false,
        'args' => array(
            'rewrite' => array(
                'slug' => ''
            ),
        ),
    );
    $portfolio_slug = yhsshu()->get_theme_opt('yhsshu_portfolio_slug', 'portfolio');
    $portfolio_label = yhsshu()->get_theme_opt('yhsshu_portfolio_label', 'Portfolio');
    $postypes['yhsshu-portfolio'] = array(
        'status'     => true,
        'item_name'  => esc_html__('Portfolio', 'yhsshu'),
        'items_name' => esc_html__('Portfolio', 'yhsshu'),
        'args'       => array(
            'menu_icon'          => 'dashicons-portfolio',
            'supports'           => array(
                'title',
                'thumbnail',
                'editor',
                'excerpt',
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'has_archive' => true,
            'rewrite'             => array(
                'slug'       => $portfolio_slug
            ),
        ),
        'labels'     => array(
            'name' => $portfolio_label,
            'add_new_item' => esc_html__('Add New Portfolio', 'yhsshu'),
            'edit_item' => esc_html__('Edit Portfolio', 'yhsshu'),
            'view_item' => esc_html__('View Portfolio', 'yhsshu'),
        )
    );

    $service_slug = yhsshu()->get_theme_opt('yhsshu_service_slug', 'service');
    $service_label = yhsshu()->get_theme_opt('yhsshu_service_label', 'Service');
    $postypes['yhsshu-service'] = array(
        'status'     => true,
        'item_name'  => esc_html__('Services', 'yhsshu'),
        'items_name' => esc_html__('Services', 'yhsshu'),
        'args'       => array(
            'menu_icon'          => 'dashicons-image-filter',
            'supports'           => array(
                'title',
                'thumbnail',
                'editor',
                'excerpt',
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'has_archive' => true,
            'rewrite'             => array(
                'slug'       => $service_slug
            ),
        ),
        'labels'     => array(
            'name' =>  $service_label,
            'add_new_item' => esc_html__('Add New Service', 'yhsshu'),
            'edit_item' => esc_html__('Edit Service', 'yhsshu'),
            'view_item' => esc_html__('View Service', 'yhsshu'),
        )

    );

    $food_slug = yhsshu()->get_theme_opt('yhsshu_food_slug', 'food');
    $food_label = yhsshu()->get_theme_opt('yhsshu_food_label', 'Food');
    $postypes['yhsshu-food'] = array(
        'status'     => true,
        'item_name'  => esc_html__('Food', 'yhsshu'),
        'items_name' => esc_html__('Food', 'yhsshu'),
        'args'       => array(
            'menu_icon'          => 'dashicons-portfolio',
            'supports'           => array(
                'title',
                'thumbnail',
                'editor',
                'excerpt',
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'has_archive' => true,
            'rewrite'             => array(
                'slug'       => $food_slug
            ),
        ),
        'labels'     => array(
            'name' => $food_label,
            'add_new_item' => esc_html__('Add New Food', 'yhsshu'),
            'edit_item' => esc_html__('Edit Food', 'yhsshu'),
            'view_item' => esc_html__('View Food', 'yhsshu'),
        )
    );

	return $postypes;
}

add_filter( 'yhsshu_extra_taxonomies', 'yhsshu_add_tax' );
function yhsshu_add_tax( $taxonomies ) {
	$taxonomies['yhsshu-portfolio-category'] = array(
		'status'     => true,
		'post_type'  => array( 'yhsshu-portfolio' ),
		'taxonomy'   => 'Categories',
		'taxonomies' => 'Categories',
        'args' => array(),
		'labels'     => array()
	);
    $taxonomies['yhsshu-portfolio-tag'] = array(
        'status'     => true,
        'post_type'  => array( 'yhsshu-portfolio' ),
        'taxonomy'   => 'Tags',
        'taxonomies' => 'Tags',
        'args' => array(),
        'labels'     => array()
    );
    $taxonomies['yhsshu-service-category'] = array(
        'status'     => true,
        'post_type'  => array( 'yhsshu-service' ),
        'taxonomy'   => 'Categories',
        'taxonomies' => 'Categories',
        'args' => array(),
        'labels'     => array()
    );
    $taxonomies['yhsshu-food-category'] = array(
        'status'     => true,
        'post_type'  => array( 'yhsshu-food' ),
        'taxonomy'   => 'Categories',
        'taxonomies' => 'Categories',
        'args' => array(),
        'labels'     => array()
    );
	return $taxonomies;
}

add_filter( 'yhsshu_theme_builder_layout_ids', 'yhsshu_theme_builder_layout_id' );
function yhsshu_theme_builder_layout_id($layout_ids){
	//default [], 
	$header_layout        = (int)yhsshu()->get_opt('header_layout');
	$header_sticky_layout = (int)yhsshu()->get_opt('header_sticky_layout');
	$header_mobile_layout = (int)yhsshu()->get_opt('header_mobile_layout');
	$ptitle_layout 	      = (int)yhsshu()->get_opt('ptitle_layout');
	$footer_layout        = (int)yhsshu()->get_opt('footer_layout');
	if( $header_layout > 0) 
		$layout_ids[] = $header_layout;
	if( $header_sticky_layout > 0) 
		$layout_ids[] = $header_sticky_layout;
	if( $header_mobile_layout > 0) 
		$layout_ids[] = $header_mobile_layout;
	if( $ptitle_layout > 0) 
		$layout_ids[] = $ptitle_layout;
	if( $footer_layout > 0) 
		$layout_ids[] = $footer_layout;
	return $layout_ids;
}

add_filter( 'yhsshu_wg_get_source_id_builder', 'yhsshu_wg_get_source_builder' );
function yhsshu_wg_get_source_builder($wg_datas){
	$wg_datas['yhsshu_slider'] = 'slider_source';
	$wg_datas['yhsshu_tabs'] = ['control_name' => 'tabs_list', 'source_name' => 'content_template'];
	return $wg_datas;
}

add_filter( 'yhsshu_template_type_support', 'yhsshu_template_type_support' );
function yhsshu_template_type_support($type){
    //default ['header','footer','mega-menu']
    $extra_type = [
        'header-mobile' => esc_html__('Header Mobile', 'yhsshu'),
        'page-title'    => esc_html__('Page Title', 'yhsshu'),
        'hidden-panel'  => esc_html__('Hidden Panel', 'yhsshu'),
        'popup'         => esc_html__('Popup', 'yhsshu'),
        'default'       => esc_html__('Default', 'yhsshu'),
    ];
    $template_type = array_merge($type, $extra_type);
    return $template_type;
}
 
add_filter( 'get_the_archive_title', 'yhsshu_archive_title_remove_label' );
function yhsshu_archive_title_remove_label( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_home() ) {
		$title = single_post_title( '', false );
	}

	return $title;
}

add_filter( 'comment_reply_link', 'yhsshu_comment_reply_text' );
function yhsshu_comment_reply_text( $link ) {
	$link = str_replace( 'Reply', ''.esc_attr__('Reply', 'yhsshu').'', $link );
	return $link;
}
 

add_filter( 'yhsshu_enable_megamenu', 'yhsshu_enable_megamenu' );
function yhsshu_enable_megamenu() {
	return true;
}
add_filter( 'yhsshu_enable_onepage', 'yhsshu_enable_onepage' );
function yhsshu_enable_onepage() {
	return true;
}

add_filter( 'yhsshu_support_awesome_pro', 'yhsshu_support_awesome_pro' );
function yhsshu_support_awesome_pro() {
	return false;
}

add_filter( 'redux_yhsshu_iconpicker_field/get_icons', 'yhsshu_add_icons_to_yhsshu_iconpicker_field' );
function yhsshu_add_icons_to_yhsshu_iconpicker_field($icons){
	$custom_icons = [];
	$icons = array_merge($custom_icons, $icons);
	return $icons;
}


add_filter("yhsshu_mega_menu/get_icons", "yhsshu_add_icons_to_megamenu");
function yhsshu_add_icons_to_megamenu($icons){
	$custom_icons = [];
	$icons = array_merge($custom_icons, $icons);
	return $icons;
}

add_filter( 'body_class', 'yhsshu_body_classes' );
function yhsshu_body_classes( $classes )
{
    $header_sticky_layout = (int)yhsshu()->get_opt('header_sticky_layout');
    $select_style = yhsshu()->get_opt('select_style', '');
    $footer_fixed = yhsshu()->get_opt('footer_fixed', '0');

    if (class_exists('ReduxFramework')) {
        $classes[] = 'redux-page';
    }

    if ($header_sticky_layout > 0) {
        $classes[] = 'header-sticky';
    }

    if($footer_fixed == '1') $classes[] = 'yhsshu-footer-fixed';

    if(!empty($select_style)) $classes[] = $select_style;

    if(get_option( 'woosw_page_id', 0) == get_the_ID())
        $classes[] = 'yhsshu-wishlist-page';

    return $classes;
}

/**
 * Move comment field to bottom
 */
add_filter( 'comment_form_fields', 'yhsshu_comment_field_to_bottom' );
function yhsshu_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

/** 
 * Custom Widget Archive 
 * This code filters the Archive widget to include the post count inside the link 
 * @since 1.0.0
*/
if(!function_exists('yhsshu_get_archives_link_text')){
    add_filter('get_archives_link', 'yhsshu_get_archives_link_text', 10, 6);
    function yhsshu_get_archives_link_text($link_html, $url, $text, $format, $before, $after ){
        $text = wptexturize( $text );
        $url  = esc_url( $url );
     
        if ( 'link' == $format ) {
            $link_html = "\t<link rel='archives' title='" . esc_attr( $text ) . "' href='$url' />\n";
        } elseif ( 'option' == $format ) {
            $link_html = "\t<option value='$url'>$before $text $after</option>\n";
        } elseif ( 'html' == $format ) {
            $link_html = "\t<li>$before<a href='$url'><span class='title'>$text</span></a>$after</li>\n";
        } else { // custom
            $link_html = "\t$before<a href='$url'><span class='title'>$text</span>$after</a>\n";
        }
        return $link_html;
    }
}

if(!function_exists('yhsshu_archive_count_span')){
    add_filter('get_archives_link', 'yhsshu_archive_count_span');
    function yhsshu_archive_count_span($links) {
        $links = str_replace('<li>', '<li class="yhsshu-list-item yhsshu-archive-item">', $links);
        $links = str_replace('</a>&nbsp;(', ' <span class="count">', $links);
        $links = str_replace(')</li>', '</span></a></li>', $links);
        return $links;
    }
}
//* Disable Lazy loading
add_filter( 'wp_lazy_loading_enabled', '__return_false' );
// remove <br> in contact form7
add_filter( 'wpcf7_autop_or_not', '__return_false' );

//* Add Custom Fonts Redux
add_filter( 'redux/'.yhsshu()->get_option_name().'/field/typography/custom_fonts', 'yhsshu_custom_fonts'); 
function yhsshu_custom_fonts($fonts){
    $fonts = [
        'Custom Fonts' => [
            'Audrey' => 'Audrey',
            'PS Demo' => 'PS Demo',
            'Souvenir' => 'Souvenir',
            'IPAMincho' => 'IPAMincho',
            'Hertine' => 'Hertine'
        ]
    ];
    return $fonts;
}

//* Add Custom Fonts Elementor
add_filter( 'elementor/fonts/groups', 'yhsshu_update_elementor_font_groups_control' );
function yhsshu_update_elementor_font_groups_control($font_groups){
    $yhsshufonts_group = array( 'yhsshufonts' => esc_html__( 'Custom Fonts', 'yhsshu' ) );
    return array_merge( $yhsshufonts_group, $font_groups );
}

add_filter( 'elementor/fonts/additional_fonts', 'yhsshu_update_elementor_font_control' );
function yhsshu_update_elementor_font_control($additional_fonts){
    $additional_fonts['Audrey'] = 'yhsshufonts';
    $additional_fonts['Cormorant Infant'] = 'yhsshufonts';
    $additional_fonts['PS Demo'] = 'yhsshufonts';
    $additional_fonts['Cirka'] = 'yhsshufonts';
    $additional_fonts['Souvenir'] = 'yhsshufonts';
    $additional_fonts['IPAMincho'] = 'yhsshufonts';
    $additional_fonts['Hertine'] = 'yhsshufonts';
    return $additional_fonts;
}