<?php

defined( 'ABSPATH' ) || exit;
?>
<div class="cart-footer-inner">
	<div class="woocommerce-mini-cart__total total">
		<span class="total-lbl"><?php echo esc_html__( 'Subtotal: ', 'yhsshu' ); ?></span>
		<span class="total-value"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
	</div>
	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
	<div class="woocommerce-mini-cart__buttons buttons">
		<?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>	
	</div>
	<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>
</div>