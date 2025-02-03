<?php
defined( 'ABSPATH' ) || exit;

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}
wp_localize_script(
	'wc-price-slider',
	'woocommerce_price_slider_params',
	array(
		'currency_format_num_decimals' => 2,
		'currency_format_symbol'       => get_woocommerce_currency_symbol(),
		'currency_format_decimal_sep'  => esc_attr( wc_get_price_decimal_separator() ),
		'currency_format_thousand_sep' => esc_attr( wc_get_price_thousand_separator() ),
		'currency_format'              => esc_attr( str_replace( array( '%1$s', '%2$s' ), array( '%s', '%v' ), get_woocommerce_price_format() ) ),
	)
);
?>
<?php do_action( 'woocommerce_widget_price_filter_start', $args ); ?>

<form method="get" action="<?php echo esc_url( $form_action ); ?>">
	<div class="price_slider_wrapper">
		<div class="price_slider" style="display:none;"></div>
		<div class="price_slider_amount" data-step="<?php echo esc_attr( $step ); ?>">
			<label class="screen-reader-text" for="min_price"><?php esc_html_e( 'Min price', 'yhsshu' ); ?></label>
			<input type="text" id="min_price" name="min_price" value="<?php echo esc_attr( $current_min_price ); ?>" data-min="<?php echo esc_attr( $min_price ); ?>" placeholder="<?php echo esc_attr__( 'Min price', 'yhsshu' ); ?>" />
			<label class="screen-reader-text" for="max_price"><?php esc_html_e( 'Max price', 'yhsshu' ); ?></label>
			<input type="text" id="max_price" name="max_price" value="<?php echo esc_attr( $current_max_price ); ?>" data-max="<?php echo esc_attr( $max_price ); ?>" placeholder="<?php echo esc_attr__( 'Max price', 'yhsshu' ); ?>" />
			<?php /* translators: Filter: verb "to filter" */ ?>
			<button type="submit" class="yhsshu-btn btn-default button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><span><?php echo esc_html__( 'Filter', 'yhsshu' ); ?></span></button>
			<div class="price_label" style="display: none;">
				<span class="from"></span> &ndash; <span class="to"></span>
			</div>
			<?php echo wc_query_string_form_fields( null, array( 'min_price', 'max_price', 'paged' ), '', true ); ?>
			<div class="clear"></div>
		</div>
	</div>
</form>

<?php do_action( 'woocommerce_widget_price_filter_end', $args ); ?>
