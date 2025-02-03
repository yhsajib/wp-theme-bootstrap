<?php
if ( ! class_exists( 'ReduxFrameworkInstances' ) ) {
	return;
}
 
class yhsshu_CSS_Generator {
	/**
     * @access protected
     * @var scssc
     */
    protected $scssc = null;

    /**
     * ReduxFramework class instance
     *
     * @access protected
     * @var ReduxFramework
     */
    protected $redux = null;

    /**
     * Debug mode is turn on or not
     *
     * @access protected
     * @var boolean
     */
    protected $dev_mode = false;

    /**
     * opt_name of ReduxFramework
     *
     * @access protected
     * @var string
     */
    protected $opt_name = '';

	function __construct() {
		$this->opt_name = yhsshu()->get_option_name();
		if ( empty( $this->opt_name ) ) {
			return;
		}
		$this->dev_mode = (defined('THEME_DEV_MODE_SCSS') && THEME_DEV_MODE_SCSS);  

        add_filter( 'yhsshu_scssc_lib', function(){ return 'new';} );
		add_filter( 'yhsshu_scssc_on', '__return_true' );
		add_action( 'init', array( $this, 'init' ) );
	}

	function init() {

		if ( ! class_exists( '\ScssPhp\ScssPhp\Compiler' ) ) {
			return;
		}

		$this->redux = ReduxFrameworkInstances::get_instance( $this->opt_name );

		if ( empty( $this->redux ) || ! $this->redux instanceof ReduxFramework ) {
			return;
		}
		add_action( 'wp', array( $this, 'generate_with_dev_mode' ) );
		add_action( "redux/options/{$this->opt_name}/saved", function () {
            $this->generate_file_options();
		} );
	}

	function generate_with_dev_mode() {
		if ( $this->dev_mode === true ) {
			$this->generate_file_options();
            $this->generate_file();
		}
	}

    function generate_file_options() {
        $scss_dir = get_template_directory() . '/assets/scss/';
        $this->scssc = new \ScssPhp\ScssPhp\Compiler();
        $this->scssc->setImportPaths( $scss_dir );
        $_options = $scss_dir . '_options.scss';

        $this->scssc->setFormatter('ScssPhp\ScssPhp\Formatter\Nested');
 
        $this->redux->filesystem->execute( 'put_contents', $_options, array(
            'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->get_options_output() )
        ) );
    }

	function generate_file() {
		$scss_dir = get_template_directory() . '/assets/scss/';
		$css_dir  = get_template_directory() . '/assets/css/';

        $this->scssc = new \ScssPhp\ScssPhp\Compiler();
        $this->scssc->setImportPaths( $scss_dir );

		
		$css_file = $css_dir . 'style.css';
         
        $this->scssc->setFormatter('ScssPhp\ScssPhp\Formatter\Nested');
  
        $this->scssc->setSourceMap(\ScssPhp\ScssPhp\Compiler::SOURCE_MAP_FILE);
        $this->scssc->setSourceMapOptions(array(
            'sourceMapWriteTo'  => $css_file . ".map",
            'sourceMapURL'      => "style.css.map",
            'sourceMapFilename' => $css_file,
            'sourceMapBasepath' => $scss_dir,
            'sourceRoot'        => $scss_dir,
        ));
  
		$this->redux->filesystem->execute( 'put_contents', $css_file, array(
			'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->scssc->compile( '@import "style.scss"' ) )
		) );
         
	}

    function generate_min_file(){   
        // Theme
        $scss_dir = get_template_directory() . '/assets/scss/';
        $css_dir  = get_template_directory() . '/assets/css/';
         
        $css_file = $css_dir . 'style.min.css';
          
        $this->scssc = new \ScssPhp\ScssPhp\Compiler();
        $this->scssc->setImportPaths( $scss_dir );
 
        $this->scssc->setSourceMap(\ScssPhp\ScssPhp\Compiler::SOURCE_MAP_FILE);
        $this->scssc->setSourceMapOptions(array(
            'sourceMapWriteTo'  => $css_file . ".map",
            'sourceMapURL'      => "style.min.css.map",
            'sourceMapFilename' => $css_file,
            'sourceMapBasepath' => $scss_dir,
            'sourceRoot'        => $scss_dir,
        ));

        $this->scssc->setFormatter( 'ScssPhp\ScssPhp\Formatter\Crunched' );
         
        $this->redux->filesystem->execute( 'put_contents', $css_file, array(
            'content' => $this->scssc->compile( '@'.'import "style.scss"' ) 
        ) );
       
    }

	protected function print_scss_opt_colors($variable,$param){
        if(is_array($variable)){
            $k = [];
            $v = [];
            foreach ($variable as $key => $value) {
                $k[] = str_replace('-', '_', $key);
                $v[] = 'var(--'.str_replace(['#',' '], [''],$key).'-color)';
            }
            if($param === 'key'){
                return implode(',', $k);
            }else{
                return implode(',', $v);
            }
            
        } else {
            return $variable;
        }
    }

	protected function get_options_output() {
		$theme_colors                    = yhsshu_configs('theme_colors');
        $links                           = yhsshu_configs('link');
        $gradients                       = yhsshu_configs('gradient');
        $body                            = yhsshu_configs('body');
        $header                          = yhsshu_configs('header');
        $heading                         = yhsshu_configs('heading');
        $heading_font_size               = yhsshu_configs('heading_font_size');
        $menu                            = yhsshu_configs('menu');
        $submenu                         = yhsshu_configs('dropdown');
        $mobile_menu                     = yhsshu_configs('mobile_menu');
        $mobile_submenu                  = yhsshu_configs('mobile_submenu');
        $border                          = yhsshu_configs('border');
        $logo                            = yhsshu_configs('logo');
        $button                          = yhsshu_configs('button');
        $input                           = yhsshu_configs('input');

		ob_start();
        foreach ($theme_colors as $key => $value) {
            printf('$%1$s_color: %2$s;', str_replace('-', '_', $key), 'var(--'.str_replace(['#',' '], [''],$key).'-color)' );
        }
        foreach ($theme_colors as $key => $value) {
            printf('$%1$s_color_rgb: %2$s;', str_replace('-', '_', $key), 'var(--'.str_replace(['#',' '], [''],$key).'-color-rgb)' );
        }
        foreach ($links as $key => $value) {
            printf('$link_%1$s: %2$s;', str_replace('-', '_', $key), 'var(--link-'.$key.')');
        }
        foreach ($gradients as $key => $value) {
            printf('$%1$s_color_from: %2$s;', str_replace('-', '_', $key), 'var(--'.str_replace(['#',' '], [''],$key).'-color-from)' );
            printf('$%1$s_color_to: %2$s;', str_replace('-', '_', $key), 'var(--'.str_replace(['#',' '], [''],$key).'-color-to)' );
            printf('$%1$s_angle: %2$s;', str_replace('-', '_', $key), 'var(--'.str_replace(['#',' '], [''],$key).'-angle)' );
        }

        foreach ($body as $key => $value) {
            printf('$body_%1$s: %2$s;', str_replace('-', '_', $key), 'var(--body-'.$key.')');
        }
        foreach ($heading as $key => $value) {
            printf('$heading_%1$s: %2$s;', str_replace('-', '_', $key), 'var(--heading-'.$key.')');
        }
        foreach ($heading_font_size as $key => $value) {
            printf('$heading_font_size_%1$s: %2$s;', str_replace('-', '_', $key), 'var(--heading-font-size-'.$key.')'); 
        }
        foreach ($logo as $key => $value) {
            printf('$logo_%1$s: %2$s;', str_replace('-', '_', $key), 'var(--logo-'.$key.')');
        }
        foreach ($header as $key => $value) {
            printf('$header_%1$s: %2$s;', str_replace('-', '_', $key), $value);
        }
        foreach ($menu as $key => $value) {
            printf('$menu_%1$s: %2$s;', str_replace('-', '_', $key), $value);
        }
        foreach ($submenu as $key => $value) {
            printf('$submenu_%1$s: %2$s;', str_replace('-', '_', $key), $value);
        }
        foreach ($mobile_menu as $key => $value) {
            printf('$mobile_menu_%1$s: %2$s;', str_replace('-', '_', $key), $value);
        }
        foreach ($mobile_submenu as $key => $value) {
            printf('$mobile_submenu_%1$s: %2$s;', str_replace('-', '_', $key), $value);
        }
        foreach ($border as $key => $value) {
            printf('$border_%1$s: %2$s;', str_replace('-', '_', $key), $value);
            printf('$border_%1$s_rgb: %2$s;', str_replace('-', '_', $key), $value);
        }
        foreach ($button as $key => $value) {
            printf('$button_%1$s: %2$s;', str_replace('-', '_', $key), $value);
        }
        foreach ($input as $key => $value) {
            printf('$input_%1$s: %2$s;', str_replace('-', '_', $key), 'var(--input-'.$key.')');
        }
		return ob_get_clean();
	}

}

new yhsshu_CSS_Generator();
