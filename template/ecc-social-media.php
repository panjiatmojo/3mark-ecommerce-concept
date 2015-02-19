<div class="ecc-social-wrapper">
  <?php if (get_option('ecc_social_enable')):?>
  <h2><?php echo get_option('ecc_social_title')?></h2>
  <?php if (get_option('ecc_facebook_enable')):?>
  <a href="<?php echo (get_option('ecc_facebook_url'));?>" class="social-button facebook"><img src="<?php echo get_template_directory_uri();?>/images/ecc-social-facebook.png" /></a>
  <?php endif; ?>
  <?php if (get_option('ecc_twitter_enable')):?>
  <a href="<?php echo (get_option('ecc_twitter_url'));?>" class="social-button twitter"><img src="<?php echo get_template_directory_uri();?>/images/ecc-social-twitter.png" /></a>
  <?php endif; ?>
  <?php if (get_option('ecc_google_enable')):?>
  <a href="<?php echo get_option('ecc_google_url');?>" class="social-button google"><img src="<?php echo get_template_directory_uri();?>/images/ecc-social-google.png" /></a>
  <?php endif; ?>  <?php if (get_option('ecc_pinterest_enable')):?>
  <a href="<?php echo get_option('ecc_pinterest_url');?>" class="social-pinterest google"><img src="<?php echo get_template_directory_uri();?>/images/ecc-social-pinterest.png" /></a>
  <?php endif; ?>
  <?php
endif;
?>
</div>
