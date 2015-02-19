<li class="latest-post-grid"> <a href="<?php echo the_permalink();?>">
  <div class="image-wrapper"><?php echo get_the_post_thumbnail( $page->ID, array(360,360) ); ?></div>
  <div class="post-content">
    <h2>
      <?php the_title(); ?>
    </h2>
    <div class="post-snippet">
      <?php the_excerpt(); ?>
    </div>
  </div>
  </a> </li>
