<?php get_header(); 
/** retrieve header here **/

	global $wp_rewrite;
?>

<div class="main-wrapper">
  <div <?php post_class('content-wrapper');?>>
    <div class="right-wrapper">
      <h1 class="title"><a href="<?php the_permalink();?>"> <span>
        <?php the_title();?>
        </span></a></h1>
      <div class="post-content">
        <?php the_content();?>
      </div>
    </div>
    <div class="divider-border"></div>
  </div>
  <div class="separator"> </div>
</div>
<?php get_footer(); ?>
