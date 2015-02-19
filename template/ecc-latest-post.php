<?php
	
	//	load content for display slider, by default using products
	$args = array(
	'post_type' => 'post',
	'posts_per_page' => get_option('ecc_latest_post_count'),
	'orderby'        => 'date',
	'order' => 'DESC'
	);
	
	$loop = new WP_Query( $args );

?>
<?php
  if ( $loop->have_posts() ) :
			while ( $loop->have_posts() ) : $loop->the_post();
  ?>
<?php get_template_part('template/ecc', 'post-grid');?>
<?php
  endwhile;
  endif;
  ?>