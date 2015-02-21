<?php get_header(); 

do_action('ecc_search_before');

//	create new query since modifying main query is not working
global $wp_query;

$keyword = get_query_var('s');
$current_page = get_query_var('paged');
$order = 'DESC';
$posts_per_page = get_option('ecc_search_limit');

$loop = new WP_Query( array(
's' => $keyword,
'order' => $order,
'post_type' => 'product',
'posts_per_page' => $posts_per_page,
'paged' => $current_page
));

?>

<!-- retrieve header here -->

<div class="main-wrapper">
  <div class="content-wrapper search">
    <div class="right-wrapper">
        <h1 class="title"><span>Search Results For "
          <?php the_search_query() ?>
          "</span></h1>
        <h2>Products</h2>
        <div class="post-content">
          <div class="product-list"> <?php echo ecc_get_pagination(); ?>
            <ul>
              <?php

		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
			
			wc_get_template_part( 'content', 'product' );
			?>
              <?php
			endwhile;
		} else {
			echo __( 'No products found' );
		}


?>
              <div style="clear:both"></div>
            </ul>
          </div>
      </div>
    </div>
  </div>
</div>
<?php

do_action('ecc_search_after');

get_footer(); ?>
