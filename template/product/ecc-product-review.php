<?php
/**	template to show features and products based on custom field	**/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce_loop;

?>
<div style="clear:both;">&nbsp;</div>
<div class="ecc-product-review">
  <h2 class="review-title section-title">
    <?php _e('Reviews');?>
  </h2>
  <?php
comments_template();
?>
</div>
