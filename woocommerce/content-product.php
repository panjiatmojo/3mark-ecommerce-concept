<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>

<li <?php post_class( $classes ); ?>>
  <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
  <div class="ecc-grid-product" style="background:#FFF;">
    <div class="ecc-grid-product-image"> <a href="<?php the_permalink(); ?>">
      <?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			
			$ecc_product_out_of_stock_temp = $product->get_availability();
			$ecc_product_out_of_stock = $ecc_product_out_of_stock_temp['class'];
			$ecc_discount_rate = ($product->get_regular_price() > 0) ? $ecc_discount_rate = number_format(-100*(1 - ($product->get_price()/$product->get_regular_price())), 0) : 9; 
		?>
      <div class="ecc-grid-product-image-wrapper"><?php echo get_the_post_thumbnail( get_the_ID(), array(360, 360));?></div>
      <div class="ecc-grid-product-out-of-stock" style="display:<?php echo ($ecc_product_out_of_stock == 'out-of-stock')? 'block': 'none' ?>">SOLD OUT!</div>
      <div class="ecc-grid-product-discount-background" style="display:<?php echo ($product->is_on_sale())? 'block': 'none' ?>">&nbsp;</div>
      <div class="ecc-grid-product-discount-rate" style="display:<?php echo ($product->is_on_sale())? 'block': 'none' ?>"><?php echo $ecc_discount_rate;?>%</div>
      <div class="ecc-grid-product-sale-banner onsale" style="display:<?php echo ($product->is_on_sale())? 'block': 'none' ?>">SALE</div>
      <div class="ecc-grid-product-new-label" style="display:<?php echo (has_term( 'new', 'product_tag'))? 'block': 'none' ?>"><img src="<?php echo get_template_directory_uri();?>/images/ecc-kontainer-new-label.png"></div>
      </a> </div>
    <div class="ecc-grid-product-info-wrapper">
      <div class="ecc-grid-product-info">
        <div style="display:table; margin:auto;">
        <div class="ecc-grid-product-title">
          <h2><?php echo get_the_title();?></h2>
        </div>
        <!--<div class="ecc-grid-product-price price"><?php echo woocommerce_price($product->get_price());?></div>--></div>
        <?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
      </div>
    </div>
    <?php //do_action( 'woocommerce_after_shop_loop_item' ); ?>
  </div>
</li>
