<?php get_header(); 

global $wp_query;

$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$max_pages = $wp_query->max_num_pages; 
?>

<div class="main-wrapper">
  <?php //include('template/ecc-display-slider.php');?>
  <div class="content-wrapper">
    <div class="right-wrapper">
      <div id="content">
        <?php if (have_posts()):  ?>
        <?php while(have_posts()) : the_post()?>
        <div <?php post_class(); ?> >
          <h1 class="title"><a href="<?php the_permalink();?>"><span>
            <?php the_title();?>
            </span>
            </a></h1>
          <?php if (has_post_thumbnail()) : ?>
          <div class="post-thumb"> <a href="<?php the_permalink();?>">
            <?php the_post_thumbnail(); ?>
            </a> </div>
          <?php endif; ?>
          <div class="post-content">
            <div class="post-thumbnail"><?php echo get_content_thumbnail();?></div>
            <div class="post-snippet"><?php echo get_content_snippet(50);?> </div>
            <?php get_read_more();?>
          <?php get_editing_tools() ?>
          <?php get_postmeta();?>
          </div>
          <div style="clear:both"></div>
        </div>
        <div class="divider-border"></div>
        <?php endwhile; ?>
        <?php echo ecc_get_pagination(); ?> </div>
      <div class="divider-border"></div>
      <?php else : ?>
      <h2> Nothing Found </h2>
      <p>No Post Found</p>
      <p><a href="<?php echo get_option('home')?>">Return to Home Page</a></p>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
