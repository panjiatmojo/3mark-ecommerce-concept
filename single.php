<?php get_header(); ?>
<!-- retrieve header here -->

<div class="main-wrapper">
  <div <?php post_class('content-wrapper');?>>
    <div class="right-wrapper">
      <div class="post-content">
        <h1 class="title"><a href="<?php the_permalink();?>"> <span>
          <?php the_title();?>
          </span></a></h1>
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
<?php get_footer(); ?>
