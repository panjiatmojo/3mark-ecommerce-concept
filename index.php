<?php get_header(); ?>

<div class="main-wrapper">
  <?php 

	wp_enqueue_script('flexslider', get_template_directory_uri().'/library/js/jquery.flexslider-min.js', array('jquery'), '1.0', false);	

	get_template_part('template/ecc', 'display-slider');
	?>
  <div class="main-content" class="index-page"> 
    <div class="ecc-product-container">
      <ul>
        <?php
	
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 12
			);
			
		$loop = new WP_Query( $args );
		
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
			
			wc_get_template_part( 'content', 'product' );

			?>
        <?php
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
?>
      </ul>
      <div style="clear:both"></div>
    </div>
    <!--<div class="ecc-post-container">
      <h2>Latest Post</h2>
      <ul>
      <?php get_template_part('template/ecc','latest-post');?>
      </ul>
      <div style="clear:both"></div>
    </div>-->
  </div>
</div>
<?php get_footer(); ?>
