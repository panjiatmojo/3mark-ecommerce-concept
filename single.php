<?php get_header(); ?>
<!-- retrieve header here -->

<div class="main-wrapper">
  <div class="content-wrapper">
    <div class="right-wrapper">
      <div <?php post_class(); ?>>
        <div class="post-content">
          <div <?php the_post(); post_class(); ?> >
            <h1 class="title"><a href="<?php the_permalink();?>"> <span>
              <?php the_title();?>
              </span></a></h1>
            <div class="post-content">
              <?php
 
	  the_content();
	  	  
	  ?>
            </div>
            <?php 
		if(get_post_type() != 'product')
		{
			get_editing_tools();
        	get_postmeta();
        }?>
          </div>
          <?php comments_template(); ?>
          <div class="divider-border"></div>
          
          <!--	show pagination here --> 
          
          <?php echo ecc_get_pagination(); ?> </div>
        
        <!-- show tile here --> 
        
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
