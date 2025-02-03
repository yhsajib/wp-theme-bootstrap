<?php
if (!class_exists('yhsshu_Header')) {
    class yhsshu_Header
    {
        public function getHeader()
        {
            $disable_header = yhsshu()->get_page_opt('disable_header','0');
            if($disable_header == '1') return; 

            $header_layout        = (int)yhsshu()->get_opt('header_layout'); 
            $header_mobile_layout = (int)yhsshu()->get_opt('header_mobile_layout'); 

            $logo_desktop = yhsshu()->get_theme_opt( 'logo_d', ['url' => get_template_directory_uri().'/assets/images/logo.png', 'id' => '' ] );
            $logo_mobile = yhsshu()->get_theme_opt( 'logo_m', ['url' => get_template_directory_uri().'/assets/images/logo.png', 'id' => '' ] );
            $p_menu = yhsshu()->get_page_opt('p_menu');
            
            $header_type = $header_layout <=0 ? 'df' : 'el';
            $header_mobile_type = $header_mobile_layout <=0 ? 'df' : 'el';

            $sticky_header_direction = yhsshu()->get_theme_opt('sticky_header_direction', 'scroll-up'); 
             
            $classes = [
                'yhsshu-header',
                'header-type-'.$header_type,
                'header-layout-'.$header_layout,
                'header-mobile-type-'.$header_mobile_type,
                'sticky-direction-'.$sticky_header_direction,
            ];
            $header_css_cls = implode(' ', $classes)
            ?>
            <header id="yhsshu-header" class="<?php echo esc_attr($header_css_cls); ?>">
                <?php if ($header_layout <= 0 || !class_exists('yhsshutheme_Core') || !is_callable( 'Elementor\Plugin::instance' )): ?>
                    <div class="header-container container d-none d-xl-block">
                        <div class="row justify-content-between align-items-center gx-100">
                            <div class="yhsshu-header-logo col-auto">
                                <?php 
                                printf(
                                    '<a class="logo-default logo-desktop" href="%1$s" title="%2$s" rel="home"><img class="yhsshu-logo" src="%3$s" alt="%2$s"/></a>',
                                    esc_url( home_url( '/' ) ),
                                    esc_attr( get_bloginfo( 'name' ) ),
                                    esc_url( $logo_desktop['url'] )
                                );
                                ?>
                            </div>
                            <div class="yhsshu-navigation col">
                                <div class="row align-items-center justify-content-end">
                                    <div class="col-12">
                                        <div class="row align-items-center justify-content-end">
                                            <div class="yhsshu-main-navigation col-12 col-xl-auto">
                                                <?php 
                                                if ( has_nav_menu( 'primary' ) ){
                                                    $attr_menu = array(
                                                        'theme_location' => 'primary',
                                                        'container'  => '',
                                                        'menu_id'    => 'yhsshu-primary-menu',
                                                        'menu_class' => 'yhsshu-primary-menu clearfix',
                                                        'link_before'     => '<span>',
                                                        'link_after'      => '</span>',
                                                        'walker'         => class_exists( 'yhsshu_Mega_Menu_Walker' ) ? new yhsshu_Mega_Menu_Walker : '',
                                                    );
                                                    if(isset($p_menu) && !empty($p_menu)) {
                                                        $attr_menu['menu'] = $p_menu;
                                                    }

                                                    wp_nav_menu( $attr_menu );
                                                }else{
                                                    printf(
                                                        '<ul class="yhsshu-primary-menu primary-menu-not-set"><li><a href="%1$s">%2$s</a></li></ul>',
                                                        esc_url( admin_url( 'nav-menus.php' ) ),
                                                        esc_html__( 'Create New Menu', 'yhsshu' )
                                                    );
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                <?php else: ?>
                    <?php if(isset($header_layout) && $header_layout > 0) : ?>
                        <div class="yhsshu-header-desktop d-none d-xl-block">
                            <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display($header_layout); ?>         
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($header_mobile_layout <= 0 || !class_exists('yhsshutheme_Core') || !is_callable( 'Elementor\Plugin::instance' )): ?>
                    <div class="yhsshu-header-mobile container d-xl-none">
                        <div class="row justify-content-between align-items-center gx-40">
                            <div class="yhsshu-header-logo col-auto">
                                <?php 
                                printf(
                                    '<a class="logo-default logo-mobile" href="%1$s" title="%2$s" rel="home"><img class="yhsshu-logo" src="%3$s" alt="%2$s"/></a>',
                                    esc_url( home_url( '/' ) ),
                                    esc_attr( get_bloginfo( 'name' ) ),
                                    esc_url( $logo_mobile['url'] )
                                );
                                ?>
                            </div>
                            <div class="col col-auto">
                                <div class="row align-items-center justify-content-end">
                                    <div class="header-mobile-nav">
                                        <span class="menu-mobile-toggle-nav open-menu yhsshu-anchor side-panel" data-target=".yhsshu-side-mobile" onclick="">
                                            <span aria-hidden="true" class="yhsshu-icon zmdi zmdi-menu"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php if(isset($header_mobile_layout) && $header_mobile_layout > 0) : ?>
                        <div class="yhsshu-header-mobile d-xl-none"> 
                            <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $header_mobile_layout); ?>      
                        </div> 
                    <?php endif; ?>
                <?php endif; ?>
            </header>
            <?php 
        }          
    }
}
