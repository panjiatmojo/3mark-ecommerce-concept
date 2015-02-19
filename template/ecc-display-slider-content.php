<a class="display-slider-content-wrapper" href="<?php echo get_permalink( get_the_ID() ); ?>">
  <div class="display-slider-title"><h2><?php echo get_the_title();?></h2></div>
  <div class="display-slider-description"><?php echo get_the_excerpt();?></div>
<div class="display-slider-image"><?php echo get_the_post_thumbnail( get_the_ID(), 'large');?> </div>
<div style="clear:both">&nbsp;</div>
</a>