<?php
/**	template to show features and products based on custom field	**/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce_loop;

?>
<div style="clear:both;">&nbsp;</div>
<div class="ecc-product-feature">
<div class="product-feature info">
  <h2 class="feature-title section-title">
    <?php _e('Feature & Specs');?>
  </h2>
<?php
if($dimensions = $product->get_dimensions()): 
?>
<div class="feature-row">
  <div class="feature-header">Dimension</div>
  <div class="feature-value">
    <?php _e($dimensions);?>
  </div>
  </div>
  <?php
endif;
if($compatibility = get_post_meta(get_the_ID(), 'compatibility', 1)): 
?>
<div class="feature-row">
  <div class="feature-header">Compatibility</div>
  <div class="feature-value">
    <?php _e($compatibility);?>
  </div>
  </div>
  <?php
endif;
if($material = get_post_meta(get_the_ID(), 'material', 1)): 
?>
<div class="feature-row">
  <div class="feature-header">Material</div>
  <div class="feature-value">
    <?php _e($material);?>
  </div>
  </div>
  <?php
endif;
if($storage = get_post_meta(get_the_ID(), 'storage', 1)): 
?>
<div class="feature-row">
  <div class="feature-header">Storage</div>
  <div class="feature-value">
    <?php _e($storage);?>
  </div>
  </div>
  <?php
endif;
?>
</div>
<div class="product-feature image">
<?php echo get_the_post_thumbnail( get_the_ID(), array(600,600) );?>
</div>
</div>

<style>


</style>
