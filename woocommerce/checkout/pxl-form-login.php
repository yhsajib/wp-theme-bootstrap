<?php
defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

?>

<button class="checkout-login-btn-toggle btn-alt" data-target=".yhsshu-login-form-checkout"><span class="yhsshu-icon lnil lnil-user"></span><?php echo esc_html__( 'Log In Your Account', 'yhsshu' ) ?></button>

<div class="yhsshu-login-form-checkout pos-fixed">
    <div class="yhsshu-hidden-template-wrap">
      	<div class="yhsshu-panel-header">
            <div class="panel-header-inner d-flex justify-content-between">
                <span class="yhsshu-title h4"><?php esc_html_e( 'Sign In', 'yhsshu' ) ?></span>
                <span class="yhsshu-close lnil lnil-close" title="<?php echo esc_attr__( 'Close', 'yhsshu' ) ?>"></span>
            </div>
        </div>
        <div class="yhsshu-panel-content custom_scroll">
           	<?php woocommerce_login_form( array( 'message'  => '', 'redirect' => wc_get_checkout_url(), 'hidden'   => false)); ?>
        </div>
    </div>
</div> 
 


