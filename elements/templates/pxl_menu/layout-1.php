<?php
$default_settings = [
    'type' => '1',
    'menu' => '',
    'el_title' => '',
    'show_arrow' => false
];
$settings = array_merge($default_settings, $settings);

$html_id = yhsshu_get_element_id($settings);  
$show_arrow_cls = ($settings['show_arrow'] === 'yes') ? 'is-arrow' : '';
$show_underline = ($settings['show_underline'] === 'yes') ? '' : 'hide-underline';
$border_hover = ($settings['border_hover'] === 'yes') ? 'border-hover' : '';
$style_cls  = $widget->get_setting('style','1');
$style_custom_cls  = $widget->get_setting('style_custom','1');

$pd_menu = yhsshu()->get_opt('pd_menu','-1');
$pm_menu = yhsshu()->get_opt('pm_menu','-1');

?>
<?php if($settings['type'] == '1'): 
    if(!empty($pd_menu) && $pd_menu != '-1') {
        $menu_pd = $pd_menu;
    }else{
        $menu_pd = $settings['menu'];
    }
    ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="yhsshu-nav-menu yhsshu-nav-menu-main style-<?php echo esc_attr($style_cls) ?> <?php echo esc_attr($show_arrow_cls.' '.$show_underline) ?>">
    <?php 
        if(!empty($menu_pd)) {
            $menu_parametter = array(
                'menu_id'    => 'yhsshu-primary-menu-'.$html_id,
                'menu_class' => 'yhsshu-primary-menu clearfix',
                'walker'     => class_exists( 'yhsshu_Mega_Menu_Walker' ) ? new yhsshu_Mega_Menu_Walker : '',
                'link_before'    => '<span class="yhsshu-menu-title">',
                'link_after'      => '</span>',
                'menu'        => wp_get_nav_menu_object($menu_pd)
            );
            wp_nav_menu($menu_parametter); 
        } elseif( has_nav_menu( 'primary' ) ) { 
            wp_nav_menu( 
                array(
                    'theme_location' => 'primary',
                    'menu_id'    => 'yhsshu-primary-menu-'.$html_id,
                    'menu_class' => 'yhsshu-primary-menu clearfix',
                    'link_before'    => '<span class="yhsshu-menu-title">',
                    'link_after'      => '</span>',
                    'walker'         => class_exists( 'yhsshu_Mega_Menu_Walker' ) ? new yhsshu_Mega_Menu_Walker : '',
                )
            );
        }
    ?>
    </div>
<?php elseif($settings['type'] == '2'): ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="yhsshu-nav-menu yhsshu-nav-menu-inner style-<?php echo esc_attr($style_cls) ?> <?php echo esc_attr($border_hover) ?>">
        <?php 
            if(!empty($settings['menu'])) { 
                $menu_parametter = array(
                    'menu_class'  => 'yhsshu-nav-inner clearfix',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'depth'       => '1',
                    'menu'        => wp_get_nav_menu_object($settings['menu']),
                    'walker'      => class_exists( 'yhsshu_Mega_Menu_Walker' ) ? new yhsshu_Mega_Menu_Walker : ''
                );
                wp_nav_menu($menu_parametter);
            } elseif( has_nav_menu( 'primary' ) ) { 
                wp_nav_menu( 
                    array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'yhsshu-nav-inner clearfix',
                        'link_before'    => '<span>',
                        'link_after'     => '</span>',
                        'depth'          => '1',
                        'walker'         => class_exists( 'yhsshu_Mega_Menu_Walker' ) ? new yhsshu_Mega_Menu_Walker : '',
                    )
                );
            }
        ?>
    </div>
<?php elseif($settings['type'] == '3'):
    if(!empty($pm_menu) && $pm_menu != '-1') {
        $menu_pm = $pm_menu;
    }else{
        $menu_pm = $settings['menu'];
    }
    ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="yhsshu-nav-menu yhsshu-nav-menu-mobile">
        <?php 
            if(!empty($menu_pm)) { 
                $menu_parametter = array(
                    'menu_id'     => 'yhsshu-mobile-menu',
                    'menu'        => wp_get_nav_menu_object($menu_pm),
                    'container'   => '',
                    'menu_class'  => 'yhsshu-mobile-menu clearfix',
                    'walker'      => class_exists( 'yhsshu_Mega_Menu_Walker' ) ? new yhsshu_Mega_Menu_Walker : '',
                    'link_before' => '<span class="yhsshu-menu-title">',
                    'link_after'  => '</span>'
                );
                wp_nav_menu($menu_parametter); 
            } elseif( has_nav_menu( 'primary' ) ) { 
                wp_nav_menu( 
                    array(
                        'theme_location' => 'primary',
                        'menu_id'     => 'yhsshu-mobile-menu',
                        'menu_class'  => 'yhsshu-mobile-menu clearfix',
                        'link_before'    => '<span class="yhsshu-menu-title">',
                        'link_after'      => '</span>',
                        'walker'         => class_exists( 'yhsshu_Mega_Menu_Walker' ) ? new yhsshu_Mega_Menu_Walker : ''
                    )
                );
            }
        ?>
    </div>
<?php elseif($settings['type'] == '4'): ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="yhsshu-nav-menu e-sidebar-widget">
        <?php if(!empty($settings['el_title'])) : ?>
            <h3 class="widget-title"><?php echo esc_html($settings['el_title']); ?></h3>
        <?php endif;
        if(!empty($settings['menu'])) {
            $menu_parametter = array(
                'menu_class'  => 'yhsshu-nav-inner clearfix',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'depth'       => '1',
                'menu'        => wp_get_nav_menu_object($settings['menu']),
                'walker'      => class_exists( 'yhsshu_Mega_Menu_Walker' ) ? new yhsshu_Mega_Menu_Walker : ''
            );
            wp_nav_menu($menu_parametter);
        } elseif( has_nav_menu( 'primary' ) ) {
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'yhsshu-nav-inner clearfix',
                    'link_before'    => '<span>',
                    'link_after'     => '</span>',
                    'depth'          => '1',
                    'walker'         => class_exists( 'yhsshu_Mega_Menu_Walker' ) ? new yhsshu_Mega_Menu_Walker : '',
                )
            );
        }
        ?>
    </div>
<?php elseif($settings['type'] == '5'):
    if(!empty($pd_menu) && $pd_menu != '-1') {
    $menu_pd = $pd_menu;
    }else{
    $menu_pd = $settings['menu'];
    }
    ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="yhsshu-nav-menu yhsshu-nav-menu-custom <?php echo esc_attr($style_custom_cls) ?>">
    <?php 
    if(!empty($menu_pd)) {
        $menu_parametter = array(
            'menu_id'    => 'yhsshu-custom-menu-'.$html_id,
            'menu_class' => 'yhsshu-custom-menu clearfix',
            'walker'     => class_exists( 'yhsshu_Mega_Menu_Walker' ) ? new yhsshu_Mega_Menu_Walker : '',
            'link_before'    => '<span class="yhsshu-menu-title">',
            'link_after'      => '</span>',
            'menu'        => wp_get_nav_menu_object($menu_pd)
        );
        wp_nav_menu($menu_parametter); 
    } elseif( has_nav_menu( 'primary' ) ) { 
        wp_nav_menu( 
            array(
                'theme_location' => 'primary',
                'menu_id'    => 'yhsshu-custom-menu-'.$html_id,
                'menu_class' => 'yhsshu-custom-menu clearfix',
                'link_before'    => '<span class="yhsshu-menu-title">',
                'link_after'      => '</span>',
                'walker'         => class_exists( 'yhsshu_Mega_Menu_Walker' ) ? new yhsshu_Mega_Menu_Walker : '',
            )
        );
    }
    ?>
     </div>
<?php endif; ?>
