<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="yhsshu-checkout-content-wrap">
	<?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>
	<?php 
		if ( !$checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
			echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'yhsshu' ) ) );
			return;
		}
	?>
	<?php 
	$has_content_top = $has_login = $has_coupon = false;
	if ( !is_user_logged_in() && 'no' !== get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
		$has_content_top = true;
		$has_login = true;
	}
	if ( wc_coupons_enabled() ) { 
		$has_content_top = true;
		$has_coupon = true;
	}
	$col_cls = ($has_login && $has_coupon) ? 'col-12 col-sm-6' : 'col-12';
	?>
	<?php if($has_content_top): ?>
		<div class="checkout-content-top row">
			<div class="col-12 col-lg-7">
				<div class="content-top-inner row">
					<?php 
					if($has_login){
						echo '<div class="login-form-col '.$col_cls.'">';
						woocommerce_checkout_login_form();
						echo '</div>';
					}
					?>
					<?php 
					if($has_coupon){
						echo '<div class="coupon-form-col '.$col_cls.'">';
						woocommerce_checkout_coupon_form();
						echo '</div>';
					}
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
		<div class="yhsshu-checkout-wrap row">
			<div class="checkout-col-left col-12 col-lg-7">
				<?php if ( $checkout->get_checkout_fields() ) : ?>

					<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

					<div id="customer_details" class="customer-details">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>

					<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				<?php endif; ?>
			</div>
			<div class="checkout-col-right col-12 col-lg-5">
				<div class="checkout-review-wrap">
					<div class="checkout-review-inner">
						<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
						
						<h4 id="order_review_heading" class="yhsshu-heading order-review-heading"><?php esc_html_e( 'Your order', 'yhsshu' ); ?></h4>
						
						<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

						<div id="order_review" class="woocommerce-checkout-review-order">
							<?php do_action( 'woocommerce_checkout_order_review' ); ?>
						</div>

						<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
					</div>
				</div>
			</div>
		</div>
	</form>

	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
</div>
