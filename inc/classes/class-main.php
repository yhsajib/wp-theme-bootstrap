<?php 

include_once( get_template_directory() . '/inc/classes/class-base.php' );
if (!class_exists('yhsshu_Main')) {
    class yhsshu_Main extends yhsshu_Base
    {
        private static $instance = null;
        protected static $options = [];
        private $option_name = 'yhsshu_theme_options';
        public $header;
        public $footer;
        public $page;
        public $pagetitle;
        public $blog;
        public $comment;
        public $render_attributes = [];

        function __construct(){
             
            // Header
            require get_template_directory() . '/inc/classes/class-header.php';
            $this->header = new yhsshu_Header();

            // Footer
            require get_template_directory() . '/inc/classes/class-footer.php';
            $this->footer = new yhsshu_Footer();

            // Page
            require get_template_directory() . '/inc/classes/class-page.php';
            $this->page = new yhsshu_Page();

            // Page title
            require get_template_directory() . '/inc/classes/class-page-title.php';
            $this->pagetitle = new yhsshu_Page_Title();

            // Blog
            require get_template_directory() . '/inc/classes/class-blog.php';
            $this->blog = new yhsshu_Blog();

            // Comment
            require get_template_directory() . '/inc/classes/class-comment.php';
            $this->comment = new yhsshu_Comment();
        }


        public static function getInstance()
        {

            if (null === self::$instance) {
                self::$instance = new yhsshu_Main();
            }

            return self::$instance;
        }

        public function require_folder($foldername, $path = ''){

            if($path === '') $path = get_template_directory();
            $dir = $path . DIRECTORY_SEPARATOR . $foldername;
            if (!is_dir($dir)) {
                return;
            }
            $files = array_diff(scandir($dir), array('..', '.'));
            foreach ($files as $file) {
                $patch = $dir . DIRECTORY_SEPARATOR . $file;
                if (file_exists($patch) && strpos($file, ".php") !== false) {
                    require_once $patch;
                }
            }
        }

        public function get_option_name(){
            return $this->option_name;
        }


        public function set_option_name($option_name){
            $this->option_name = $option_name;
            return $this;
        }

        public function get_name(){
            $theme = wp_get_theme();
            if( $theme->parent_theme ) {
                $template_dir  = basename( get_template_directory() );
                $theme = wp_get_theme( $template_dir );
            }
            return $theme->get('Name');
        }

        public function get_slug(){ 
            return get_template();
        }

        public function get_version(){
            $theme = wp_get_theme();
            if( $theme->parent_theme ) {
                $template_dir  = basename( get_template_directory() );
                $theme = wp_get_theme( $template_dir );
            }
            return $theme->get('Version');
        }

        public function get_theme_opt($setting = null, $default = false, $subset = false){
            if (is_null($setting) || empty($setting)) {
                return '';
            }

            if (empty(self::$options)) {
                self::$options = self::$instance->get_options();
            }

            if (empty(self::$options) || ! isset( self::$options[ $setting ] ) || self::$options[ $setting ] === ''){
                if ( $subset && !empty($subset)) 
                    return $default[$subset];
                else
                    return $default;
            }

            if(is_array(self::$options[$setting])) {
                if( is_array($default) ){
                    foreach (self::$options[$setting] as $key => $value){
                        if(empty(self::$options[$setting][$key]) && isset($default[$key]))
                            self::$options[$setting][$key] = $default[$key];
                    }
                }else{
                    foreach (self::$options[$setting] as $key => $value){
                        if(empty(self::$options[$setting][$key]) && isset($default))
                            self::$options[$setting][$key] = $default;
                         
                    }
                }
            } 

            if (!$subset || empty($subset)) {
                return self::$options[$setting];
            }

            if (isset(self::$options[$setting][$subset])) {
                return self::$options[$setting][$subset];
            }
            
            return self::$options;
        }

        public function get_page_opt($setting = null, $default = false, $subset = false){
            if (is_null($setting) || empty($setting)) {
                return '';
            }

            $id = get_the_ID();

            if(class_exists('WooCommerce') && is_shop()){
                $real_page = get_post(wc_get_page_id('shop'));
            }else{
                $real_page =  get_queried_object();
            }

            if($real_page instanceof WP_Post){
                $id = $real_page->ID;
            }
            

            $options = !empty($id) && ('' !== get_post_meta($id, $setting, true)) ? get_post_meta($id, $setting, true) : $default;
            if( !empty($id) && ('' !== get_post_meta($id, $setting, true)) ){
                $options = get_post_meta($id, $setting, true);
                if(is_array($options)) {
                    if( is_array($default) ){
                        foreach ($options as $key => $value){
                            if(empty($options[$key]) && isset($default[$key]))
                                $options[$key] = $default[$key];
                        }
                    }else{
                        foreach ($options as $key => $value){
                            if(empty($options[$key]) && isset($default))
                                $options[$key] = $default;
                             
                        }
                    }
                }
            }else{
                $options = $default;
            }
            

            if ($subset && !empty($subset)) {  
                if (isset($options[$subset])) {
                    $options = $options[$subset];
                }
            } 

            return $options;

        }

        public function get_opt($setting = null, $default = false, $subset = false){

            if (is_null($setting) || empty($setting)) {
                return '';
            }
             
            $theme_opt = $this->get_theme_opt($setting, $default);
            $page_opt  = $this->get_page_opt($setting, $theme_opt);
            if( $page_opt !== NULL && $page_opt !== '' && $page_opt !== '-1'){
                if(is_array($page_opt) && is_array($theme_opt)){
                    foreach ($page_opt as $key => $value) {
                        if(empty($page_opt[$key]) || $page_opt[$key] === 'px') 
                            $page_opt[$key] = $theme_opt[$key];
                    }
                }
                $theme_opt = $page_opt;
            }

            if ($subset && !empty($subset)) {  
                if (isset($theme_opt[$subset])) {
                    $theme_opt = $theme_opt[$subset];
                }
            }

            return $theme_opt;

        }

        public function set_options($setting, $value){

            if (empty(self::$options)) {
                self::$options = self::get_options();
            }

            $options = self::$options;

            $options[$setting] = $value;

            update_option($this->get_option_name(), $options);

            return $this;
        }

        public static function get_options(){

            $options = get_option(self::$instance->get_option_name(), []);

            return $options;
        }

        public function get_sidebar_args($args = []){
            $args = wp_parse_args($args, [
                'type' => 'blog',
                'content_col' => '8'
            ]);

            $sidebars = ['content_class' => 'col-lg-8 col-xl-8', 'sidebar_class' => 'col-lg-4 col-xl-4', 'wrap_class' => 'yhsshu-content-wrap'];

            $sidebar_reg = is_singular( 'post' ) ? 'blog' : $args['type'];
            $sidebar_reg = is_singular( 'product' ) ? 'shop' : $sidebar_reg;

            $sidebar_active = is_active_sidebar('sidebar-'.$sidebar_reg);

            $default_pos = $args['type'] == 'page' ? '0' : 'right';  
            $sidebar_pos = $this->get_opt($args['type'] . '_sidebar_pos', $default_pos);
            $order_cls = $sidebar_pos == 'left' ? 'order-lg-2' : '';
            $sidebar_sticky = $this->get_theme_opt('sidebar_sticky','0');
            $sbs_cls = ($sidebar_sticky == '1') ? 'sidebar-sticky' : '';
            $yhsshu_sidebar_style = $this->get_theme_opt('sidebar_style', 'default');
            if ($sidebar_pos === '0' || $sidebar_pos === 'none' || $sidebar_pos === '' || !$sidebar_active) {
                $sidebars['wrap_class'] = 'yhsshu-content-wrap no-sidebar';
                $sidebars['content_class'] = 'yhsshu-content-area content-'.$args['type']. ' col-12';
                $sidebars['sidebar_class'] = false;
            } else {
                $sidebar_class = 12 - (int)$args['content_col'];
                $sidebars['wrap_class'] = 'yhsshu-content-wrap has-sidebar sidebar-'.$sidebar_pos;
                $sidebars['content_class'] = 'yhsshu-content-area content-'.$args['type']. ' col-12 col-lg-8 col-xl-'.$args['content_col']. ' '.$order_cls;
                $sidebars['sidebar_class'] = 'yhsshu-sidebar-area sidebar-'.$args['type'].' '.esc_attr($yhsshu_sidebar_style).' '.$sbs_cls.' col-12 col-lg-4 col-xl-'.$sidebar_class;
            }

            return $sidebars;
        }

        public function get_sidebar(){
            if ( class_exists( 'WooCommerce' ) && (is_product_category() || is_shop() || is_product()) ) {
                $sidebar = 'sidebar-shop';
            } elseif( is_singular('page') ) {
                $sidebar = 'sidebar-page';
            } else {
                $sidebar = 'sidebar-blog';
            }
            return $sidebar;
        }

        public function add_render_attribute( $element, $key = null, $value = null, $overwrite = false ) {
            if ( is_array( $element ) ) {
                foreach ( $element as $element_key => $attributes ) {
                    $this->add_render_attribute( $element_key, $attributes, null, $overwrite );
                }

                return $this;
            }

            if ( is_array( $key ) ) {
                foreach ( $key as $attribute_key => $attributes ) {
                    $this->add_render_attribute( $element, $attribute_key, $attributes, $overwrite );
                }

                return $this;
            }

            if ( empty( $this->render_attributes[ $element ][ $key ] ) ) {
                $this->render_attributes[ $element ][ $key ] = [];
            }

            settype( $value, 'array' );

            if ( $overwrite ) {
                $this->render_attributes[ $element ][ $key ] = $value;
            } else {
                $this->render_attributes[ $element ][ $key ] = array_merge( $this->render_attributes[ $element ][ $key ], $value );
            }

            return $this;
        }

        public function get_render_attributes( $element = '', $key = '') {
            $attributes = $this->render_attributes;

            if ( $element ) {
                if ( ! isset( $attributes[ $element ] ) ) {
                    return null;
                }

                $attributes = $attributes[ $element ];

                if ( $key ) {
                    if ( ! isset( $attributes[ $key ] ) ) {
                        return null;
                    }

                    $attributes = $attributes[ $key ];
                }
            }
            
            return $attributes;
        }
        
        public function get_render_attribute_string( $element ) {
            if ( empty( $this->render_attributes[ $element ] ) ) {
                return '';
            }

            return $this->render_html_attributes( $this->render_attributes[ $element ] );
        }

        public function render_html_attributes( array $attributes ) {
            $rendered_attributes = [];

            foreach ( $attributes as $attribute_key => $attribute_values ) {
                if ( is_array( $attribute_values ) ) {
                    $attribute_values = implode( ' ', $attribute_values );
                }

                $rendered_attributes[] = sprintf( '%1$s="%2$s"', $attribute_key, esc_attr( $attribute_values ) );
            }

            return implode( ' ', $rendered_attributes );
        }

        public function print_render_attribute_string( $element ) {
            echo ''.$this->get_render_attribute_string( $element );  
        }
    }
}
 

function yhsshu() {
    return yhsshu_Main::getInstance();
}
// Install
yhsshu();

yhsshu_action( 'init' );