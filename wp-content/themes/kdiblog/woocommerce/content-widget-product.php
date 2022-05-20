<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

?>
<div class="col">
<div id="product-<?php esc_attr( the_ID() ); ?>" class="widget-product">
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>

	<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
		<div class="widget-product__thumbnail ratio ratio-1x1">
			<img
				alt="Product thumbnail"
				class="rounded h-100"
				src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>"
			>
		</div>

		<span class="widget-product__title"><?php echo wp_kses_post( $product->get_name() ); ?></span>
	</a>

	<?php if ( ! empty( $show_rating ) ) : ?>
		<?php echo wc_get_rating_html( $product->get_average_rating() ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php endif; ?>

	<p class="widget-product__price">
		<?php echo $product->get_price_html(); ?>
	</p>
	
	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
</div>
</div>