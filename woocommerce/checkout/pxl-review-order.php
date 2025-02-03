<?php

defined( 'ABSPATH' ) || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table">
	<div class="review-order-list">
		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<div class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> row gx-15 justify-content-between">
					<div class="product-thumbs col-auto">
						<?php
							yhsshu_print_html($_product->get_image());
						?>
					</div>
					<div class="product-name col">
						<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <span class="product-quantity">' . sprintf( '%s&nbsp;&times;&nbsp;', $cart_item['quantity'] ) . '</span>', $cart_item, $cart_item_key ); ?>
						<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) ; ?>
						<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
					</div>
					<div class="product-total col-auto">
						<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
					</div>
				</div>
				<?php
			}
		}

		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</div>
	<div class="review-order-subtotal-shiping">
		<div class="cart-subtotal d-flex align-items-center justify-content-between"> 
			<span class="lbl"><?php esc_html_e( 'Subtotal', 'yhsshu' ); ?></span>
			<span class="value"><?php wc_cart_totals_subtotal_html(); ?></span>
		</div>
		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
		<div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?> d-flex align-items-center justify-content-between"> 
			<span class="lbl"><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
			<span class="value"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
		</div>
		<?php endforeach; ?>
		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>
		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="fee d-flex align-items-center justify-content-between"> 
				<span class="lbl"><?php echo esc_html( $fee->name ); ?></span>
				<span class="value"><?php wc_cart_totals_fee_html(); ?></span>
			</div>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<div class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?> d-flex align-items-center justify-content-between"> 
						<span class="lbl"><?php echo esc_html( $tax->label ); ?></span>
						<span class="value"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="tax-total d-flex align-items-center justify-content-between"> 
					<span class="lbl"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span>
					<span class="value"><?php wc_cart_totals_taxes_total_html(); ?></span>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
	<div class="order-total d-flex align-items-center justify-content-between"> 
		<span class="lbl"><?php esc_html_e( 'Total', 'yhsshu' ); ?></span>
		<span class="value"><?php wc_cart_totals_order_total_html(); ?></span>
	</div>
	<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
	
</div>

