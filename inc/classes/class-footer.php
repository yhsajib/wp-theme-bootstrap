<?php
//use Elementor\Core\Files\CSS\Post as Post_CSS;
if (!class_exists('yhsshu_Footer')) {
     
    class yhsshu_Footer
    {
         
        public function getFooter(){
            $disable_footer        = (int)yhsshu()->get_opt('disable_footer');
            if ($disable_footer){
                return true;
            }
            $footer_layout = (int)yhsshu()->get_opt('footer_layout');
            $footer_type = $footer_layout <= 0 ? 'df' : 'el';
            $css_classes = [
                'yhsshu-footer',
                'footer-type-'.$footer_type,
                'footer-layout-'.$footer_layout
            ];
            $footer_wrap_cls = trim(implode(' ', $css_classes));

            if ($footer_layout <= 0 || !class_exists('yhsshutheme_Core') || !is_callable( 'Elementor\Plugin::instance' )) {  
                ?>
                <footer id="yhsshu-footer" class="<?php echo esc_attr($footer_wrap_cls);?>">
                    <?php do_action('yhsshu_before_footer'); ?>
                    <div class="yhsshu-footer-bottom">
                        <div class="container">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-12 col-md-auto text-center">
                                    <div class="yhsshu-copyright-text yhsshu-footer-copyright">
                                        <?php 
                                        printf( esc_html__('Copyright © %s yhsshu by %s. All Rights Reserved','yhsshu'), date('Y'), '<a href="'.esc_url('https://themeforest.net/user/7iquid/portfolio').'" target="_blank" rel="nofollow">7iquid</a>');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php do_action('yhsshu_after_footer');  ?>
                </footer>
                <?php 
            } else { 
                ?>
                <footer id="yhsshu-footer" class="<?php echo esc_attr($footer_wrap_cls);?>">
                    <?php 
                        do_action('yhsshu_before_footer');
                        echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $footer_layout);
                        do_action('yhsshu_after_footer');
                    ?>
                </footer> 
                <?php  
            } 
        }
 
    }
}
 
 