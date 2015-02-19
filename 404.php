<?php get_header(); 
/** retrieve header here **/

	global $wp_rewrite;
?>

<div class="main-wrapper">
  <div class="content-wrapper">
    <div class="right-wrapper">
      <div class="post-wrapper">
        <div <?php the_post(); post_class(); ?> >
          <h1 class="title"><a href="<?php echo site_url();?>"><span>Ooops, No Page Found, ERROR 404
            </span></a></h1>
          <div class="post-content">
          </div>
        </div>
        <div class="divider-border"></div>
      </div>
    </div>
  </div>
  <div class="separator"> </div>
</div>
<?php get_footer(); ?>
