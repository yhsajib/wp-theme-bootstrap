<?php

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_shipping_calculator' ); ?>

<form class="woocommerce-shipping-calculator" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

	<?php printf( '<a href="#" class="shipping-calculator-button">%s</a>', esc_html( ! empty( $button_text ) ? $button_text : __( 'Calculate shipping', 'yhsshu' ) ) ); ?>

	<section class="shipping-calculator-form" style="display:none;">

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_country', true ) ) : ?>
			<p class="form-row form-row-wide" id="calc_shipping_country_field">
				<label for="calc_shipping_country" class="screen-reader-text"><?php esc_html_e( 'Country / region:', 'yhsshu' ); ?></label>
				<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state country_select" rel="calc_shipping_state">
					<option value="default"><?php esc_html_e( 'Select a country / region&hellip;', 'yhsshu' ); ?></option>
					<?php
					foreach ( WC()->countries->get_shipping_countries() as $key => $value ) {
						echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
					}
					?>
				</select>
			</p>
		<?php endif; ?>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_state', true ) ) : ?>
			<p class="form-row form-row-wide" id="calc_shipping_state_field">
				<?php
				$current_cc = WC()->customer->get_shipping_country();
				$current_r  = WC()->customer->get_shipping_state();
				$states     = WC()->countries->get_states( $current_cc );

				if ( is_array( $states ) && empty( $states ) ) {
					?>
					<input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php esc_attr_e( 'State / County', 'yhsshu' ); ?>" />
					<?php
				} elseif ( is_array( $states ) ) {
					?>
					<span>
						<label for="calc_shipping_state" class="screen-reader-text"><?php esc_html_e( 'State / County:', 'yhsshu' ); ?></label>
						<select name="calc_shipping_state" class="state_select" id="calc_shipping_state" data-placeholder="<?php esc_attr_e( 'State / County', 'yhsshu' ); ?>">
							<option value=""><?php esc_html_e( 'Select an option&hellip;', 'yhsshu' ); ?></option>
							<?php
							foreach ( $states as $ckey => $cvalue ) {
								echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
							}
							?>
						</select>
					</span>
					<?php
				} else {
					?>
					<label for="calc_shipping_state" class="screen-reader-text"><?php esc_html_e( 'State / County:', 'yhsshu' ); ?></label>
					<input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php esc_attr_e( 'State / County', 'yhsshu' ); ?>" name="calc_shipping_state" id="calc_shipping_state" />
					<?php
				}
				?>
			</p>
		<?php endif; ?>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', true ) ) : ?>
			<p class="form-row form-row-wide" id="calc_shipping_city_field">
				<label for="calc_shipping_city" class="screen-reader-text"><?php esc_html_e( 'City:', 'yhsshu' ); ?></label>
				<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php esc_attr_e( 'City', 'yhsshu' ); ?>" name="calc_shipping_city" id="calc_shipping_city" />
			</p>
		<?php endif; ?>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>
			<p class="form-row form-row-wide" id="calc_shipping_postcode_field">
				<label for="calc_shipping_postcode" class="screen-reader-text"><?php esc_html_e( 'Postcode / ZIP:', 'yhsshu' ); ?></label>
				<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php esc_attr_e( 'Postcode / ZIP', 'yhsshu' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
			</p>
		<?php endif; ?>
		<?php $button_style = yhsshu()->get_theme_opt('cart_button_style', 'btn_outline_secondary'); ?>
		<p class="calc_shipping_wrap">
			<button type="submit" name="calc_shipping" value="1" class="btn <?php echo esc_attr($button_style); ?> button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>">
				<span><?php esc_html_e( 'Update', 'yhsshu' ); ?></span>
			</button>
		</p>
		<?php wp_nonce_field( 'woocommerce-shipping-calculator', 'woocommerce-shipping-calculator-nonce' ); ?>
	</section>
</form>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>
