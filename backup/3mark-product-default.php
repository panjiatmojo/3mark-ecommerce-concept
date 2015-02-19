<?php
	global $wp_query, $post, $emark_product_grid_array;
	
    $max_pages = $wp_query->max_num_pages;	//	store the max pages
	if($wp_query->have_posts()):    
?>

<div class="latest-item">
  <h1 class="title"> <span><?php echo $emark_product_grid_array['category_name']; ?></span> </h1>
  <div class="wpsc_default_product_list">

	<?php require('3mark-product-grid.php'); ?>

  </div>
</div>
<?php
	
    endif;
?>