<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

?>
<li>
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>
	<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
		<?php yhsshu_print_html($product->get_image()); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</a>
	<div class="product-info">
		<div class="d-flex">
			<div class="product-price">
				<?php yhsshu_print_html($product->get_price_html()); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<?php if ( ! empty( $show_rating ) ) : ?>
				<?php echo wc_get_rating_html( $product->get_average_rating() ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php endif; ?>
		</div>
		<a href="<?php echo esc_url( $product->get_permalink()); ?>">
			<span class="product-title"><?php echo wp_kses_post( $product->get_name() ); ?></span>
		</a>
	</div>
	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
</li>