<div class="ecc-social-wrapper">
  <?php if (get_option('ecc_contact_enable')):?>
  <h2><?php echo __(get_option('ecc_contact_title'))?></h2>
  <h3><?php echo __('Phone').' ';?><a href="tel://<?php _e(get_option('ecc_contact_phone_1'));?>"><?php _e(get_option('ecc_contact_phone_1'));?></a></h3>
  <h3><?php echo __('E-mail').' '.__(get_option('ecc_contact_email'));?></h3>  
  <?php
endif;
?>
</div>
