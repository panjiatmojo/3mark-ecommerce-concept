<?php

if(get_option('ecc_slider_enable')):

wp_enqueue_script('ecc-display-slider', get_template_directory_uri().'/library/js/ecc-init-slider.js', array('jquery', 'ecc-function'), '1.0', false);
	//	only show flexslider if category display is available and device type is not mobile
	
	$slider_count = get_option('ecc_slider_count');
	
	//	load content for display slider, by default using products
	$args = array(
	'post_type' => 'banner',
	'posts_per_page' => $slider_count,
	'orderby'        => 'rand'
	);
	
	$loop = new WP_Query( $args );
	
?>

<div id="slider-wrapper">
  <input type="hidden" id="ecc-slider-full-screen" value="<?php echo get_option('ecc_slider_full_screen');?>" />
  <input type="hidden" id="flexslider-height" value="<?php echo get_option('ecc_slider_height_ratio');?>" />
  <input type="hidden" id="flexslider-width" value="<?php echo get_option('ecc_slider_width_ratio');?>" />
  <input type="hidden" id="flexslider-pause" value="<?php echo get_option('ecc_slider_pause');?>" />
  <input type="hidden" id="flexslider-duration" value="<?php echo get_option('ecc_slider_duration');?>" />
  <input type="hidden" id="flexslider-animation" value="<?php echo get_option('ecc_slider_animation');?>" />
  <div style="display:none;" class="flexslider" <?php /* Remove margin if only one slide */ 
  if($slider_count == 1) { echo 'style="margin: 0;"'; } ?>>
    <ul class="slides">
      <?php
  if ( $loop->have_posts() ) :
			while ( $loop->have_posts() ) : $loop->the_post();
  ?>
      <li style="display:none;">
        <?php get_template_part('template/ecc', 'display-slider-content');?>
      </li>
      <?php
  endwhile;
  endif;
  
    ?>
    </ul>
  </div>
</div>
<?php
endif;
?>
