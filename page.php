<?php get_header(); 
/** retrieve header here **/

	global $wp_rewrite;
?>

<div class="main-wrapper">
  <div class="content-wrapper">
    <div class="right-wrapper">
      <div class="post-wrapper">
        <div <?php the_post(); post_class(); ?> >
          <!--<h1 class="title"><a href="<?php the_permalink();?>"> <span>
            <?php the_title();?>
            </span></a></h1>-->
          <div class="post-content">
            <?php the_content();?>
          </div>
        </div>
        <div class="divider-border"></div>
      </div>
    </div>
  </div>
  <div class="separator"> </div>
</div>
<?php get_footer(); ?>
