<?php
/**	template to show features and products based on custom field	**/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce_loop;
?>

<div class="ecc-product-new-label" style="display:<?php echo (has_term( 'new', 'product_tag', get_the_ID()))? 'block': 'none' ?>">
<img src="<?php echo get_template_directory_uri();?>/images/ecc-kontainer-new-label.png"></div>

<style>
.ecc-product-new-label
{
	position: absolute;
	top:0;
	right:0;
	width:auto;
	height:auto;
	display:inline-block;	
}
</style>
