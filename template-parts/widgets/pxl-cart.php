<?php
defined( 'ABSPATH' ) || exit;
if (!class_exists('Woocommerce')) return;

if (!function_exists('Ysshu_Register_wp_widget')) return;
add_action('widgets_init', function () {
	Ysshu_Register_wp_widget('yhsshu_Cart_Widget');
});

class yhsshu_Cart_Widget extends WC_Widget {

	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_shopping_cart';
		$this->widget_description = __( 'Display the customer shopping cart.', 'yhsshu' );
		$this->widget_id          = 'yhsshu_cart_widget';
		$this->widget_name        = __( '* yhsshu Cart', 'yhsshu' );
		$this->settings           = array(
			'title'         => array(
				'type'  => 'text',
				'std'   => __( 'Cart', 'yhsshu' ),
				'label' => __( 'Title', 'yhsshu' ),
			),
			'layout'        => array(
				'type'    => 'select',
				'std'     => 'layout-1',
				'label'   => __( 'Layout', 'yhsshu' ),
				'options' => array(
					'layout-1' => __( 'Layout 1', 'yhsshu' ),
					'layout-2' => __( 'Layout 2', 'yhsshu' ),
					'layout-3' => __( 'Layout 3', 'yhsshu' ),
					'layout-4' => __( 'Layout 4', 'yhsshu' ),
					'layout-5' => __( 'Layout 5', 'yhsshu' ),
				),
			),
		);

		if ( is_customize_preview() ) {
			wp_enqueue_script( 'wc-cart-fragments' );
		}

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		if ( apply_filters( 'woocommerce_widget_cart_is_hidden', is_cart() || is_checkout() ) ) {
			return;
		}

		wp_enqueue_script( 'wc-cart-fragments' );

		if ( ! isset( $instance['title'] ) ) {
			$instance['title'] = __( 'Cart', 'yhsshu' );
		}

		if ( ! isset( $instance['layout'] ) ) {
			$instance['layout'] = 'layout-1';
		}

		$this->widget_start( $args, $instance );

		echo '<div class="yhsshu-cart-widget ' . $instance['layout'] . '">' ;
		if ( !\Elementor\Plugin::$instance->editor->is_edit_mode()) :
			woocommerce_mini_cart();
			wc_get_template( 'cart/mini-cart-totals.php' );
		else :
			echo esc_html('Can not show this content in Elementor Edit Mode. You can check this content in frontend shop page.', 'yhsshu');
		endif;
		echo '</div>';

		$this->widget_end( $args );
	}
}