<?php
//Message
if(!function_exists('yhsshu_woocommerce_checkout_coupon_message')){
	add_filter('woocommerce_checkout_coupon_message','yhsshu_woocommerce_checkout_coupon_message');
	function yhsshu_woocommerce_checkout_coupon_message(){
		return '<span class="yhsshu-added-to-cart-msg">'.esc_html__( 'Have a coupon?', 'yhsshu' ) . '</span> <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'yhsshu' ) . '</a>';
	}
}

// add inner wrap div to order review columns
if(!function_exists('yhsshu_woocommerce_checkout_order_review_inner_open')){
	add_action('woocommerce_checkout_order_review','yhsshu_woocommerce_checkout_order_review_inner_open', 0);
	function yhsshu_woocommerce_checkout_order_review_inner_open(){
		echo '<div class="yhsshu-woocommerce-checkout-review-order-inner p-30 bg-accent yhsshu-radius-12">';
	}
}
if(!function_exists('yhsshu_woocommerce_checkout_order_review_inner_close')){
	add_action('woocommerce_checkout_order_review','yhsshu_woocommerce_checkout_order_review_inner_close', 999);
	function yhsshu_woocommerce_checkout_order_review_inner_close(){
		echo '</div>';
	}
}

// add div wrap content after order review title
if(!function_exists('yhsshu_woocommerce_checkout_order_review_inner2_open'))
{
	add_action('woocommerce_checkout_order_review','yhsshu_woocommerce_checkout_order_review_inner2_open', 2);
	function yhsshu_woocommerce_checkout_order_review_inner2_open(){
		echo '<div class="yhsshu-woocommerce-checkout-review-order-inner2 overflow-hidden text-body">';
	}
}
if(!function_exists('yhsshu_woocommerce_checkout_order_review_inner2_close'))
{
	add_action('woocommerce_checkout_order_review','yhsshu_woocommerce_checkout_order_review_inner2_close', 998);
	function yhsshu_woocommerce_checkout_order_review_inner2_close(){
		echo '</div>';
	}
}

//custom proceed to paypal button
if(!function_exists('yhsshu_woocommerce_order_button_html')){
	add_filter('woocommerce_order_button_html', 'yhsshu_woocommerce_order_button_html');
	function yhsshu_woocommerce_order_button_html(){
		$order_button_text = apply_filters( 'woocommerce_order_button_text', esc_html__( 'Place order', 'yhsshu' ) );
		return '<div class="yhsshu-checkout-place-order"><button type="submit" class="button" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button></div>';
	}
}