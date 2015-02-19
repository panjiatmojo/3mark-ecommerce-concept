<?php
  
  //	show category
  global $query_reference;
  
 	//if ( $query_reference->get( 'post_type') == 'wpsc-product' || $query_reference->get('wpsc_product_category')) : ?>

<div id="footer-wrapper">
  <!--<ul id="footer-first-wrapper" class="footer-widget-wrapper">
    <li class="footer-widget-container">
      <?php require('template/ecc-social-media.php');?>
    </li>
    <li class="footer-widget-container">
      <?php require('template/ecc-contact-us.php');?>
    </li>
  </ul>-->
  <div style="clear:both"></div>
  <!--<ul id="footer-second-wrapper" class="footer-widget-wrapper">
    <li>
      <?php require('template/ecc-partner.php');?>
    </li>
  </ul>-->
  <div style="clear:both"></div>
  <div class="footer">
    <div class="footer-widget-container">
      <ul id="left-widget" >
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Left Widgets') ) : ?>
        <?php endif; ?>
      </ul>
    </div>
    <div class="footer-widget-container">
      <ul id="center-widget">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Center Widgets') ) : ?>
        <?php endif; ?>
      </ul>
    </div>
    <div class="footer-widget-container">
      <ul id="right-widget">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Right Widgets') ) : ?>
        <?php endif; ?>
      </ul>
    </div>
    <div class="separator"></div>
  </div>
  <div class="desktop-view">
    <?php if(is_mobile()) {
		  //	show desktop view / mobile view for respective device?>
    <a href="?mobile=0"><?php echo (get_option('3mark_word_show_desktop'));?></a>
    <?php } 
	  elseif(!is_mobile())
	  {?>
    <a href="?mobile=1"><?php echo (get_option('3mark_word_show_mobile'));?></a>
    <?php } ?>
  </div>
  <div class="credit-wrapper">
    <h2 class="credit"> <?php echo get_option('blogname');?>&copy; 2014, <a href="http://theatmojo.com/3mark">3mark</a>, all rights reserved <?php if(get_option('ecc_loading_time_enable')) ecc_show_loading_time();?>  </h2>
  </div>
</div>
<?php wp_footer(); ?>
</body></html>