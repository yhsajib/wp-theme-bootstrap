<?php
  
defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">
	<?php do_action( 'woocommerce_before_cart_totals' ); ?>
	<h4 class="yhsshu-heading"><?php esc_html_e( 'Order Summary', 'yhsshu' ); ?></h4>

	<div class="cart-total-inner">
		<div class="sub-total cart-total-row d-flex align-items-center justify-content-between">
			<span class="lbl"><?php esc_html_e( 'Subtotal', 'yhsshu' ); ?></span>
			<span class="value"><?php wc_cart_totals_subtotal_html(); ?></span>
		</div>
		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="cart-discount cart-total-row coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?> d-flex align-items-center justify-content-between">
				<span class="lbl"><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
				<span><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
			</div>
		<?php endforeach; ?>
		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
			<?php wc_cart_totals_shipping_html(); ?>
			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
			<div class="shipping cart-total-row d-flex align-items-center justify-content-between"> 
				<span class="lbl"><?php esc_html_e( 'Shipping', 'yhsshu' ); ?></span>
				<span class="value"><?php woocommerce_shipping_calculator(); ?></span>
			</div>
		<?php endif; ?>
		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="fee cart-total-row d-flex align-items-center justify-content-between">
				<span class="lbl"><?php echo esc_html( $fee->name ); ?></span>
				<span class="value"><?php wc_cart_totals_fee_html( $fee ); ?></span>
			</div>
		<?php endforeach; ?>
		<?php
		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';
			if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) { 
				$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'yhsshu' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
			}
			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { 
					?>
					<div class="tax-rate cart-total-row tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?> d-flex align-items-center justify-content-between">
						<span class="lbl"><?php echo esc_html( $tax->label ) . $estimated_text;  ?></span>
						<span class="value"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
					</div>
					<?php
				}
			} else {
				?>
				<div class="tax-total cart-total-row d-flex align-items-center justify-content-between">
					<span class="lbl"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></span>
					<span class="value"><?php wc_cart_totals_taxes_total_html(); ?></span>
				</div>
				<?php
			}
		}
		?>
		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>
		<div class="order-total d-flex align-items-center justify-content-between">
			<span class="lbl"><?php esc_html_e( 'Total', 'yhsshu' ); ?></span>
			<span class="value"><?php wc_cart_totals_order_total_html(); ?></span>
		</div>
		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
	</div>
	<div class="wc-proceed-to-checkout">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>
	<?php do_action( 'woocommerce_after_cart_totals' ); ?>
</div>
