<?php do_action('ecc_header_before');?>
<?php 
	wp_enqueue_script('flexnav', get_template_directory_uri().'/library/js/jquery.flexnav.min.js', array('jquery'), '1.0', false);
	wp_enqueue_style( 'flexnav-style',  get_template_directory_uri().'/library/css/flexnav.css', array(), '1.0.0' );
?>

<div class="header-wrapper">
  <header class="header">
    <nav class="header-sub-wrapper left">
      <?php get_template_part('template/ecc', 'nav-menu');?>
    </nav>
    <a href="#">
    <div class="up-arrow"> <img src="
<?php echo get_template_directory_uri();?>
/images/3mark-up-arrow.png"/> </div>
    </a> </header>
  <div style="clear:both"> </div>
</div>
<?php do_action('ecc_header_after');?>
