<?php if(get_option('ecc_partner_enable')):?>
<div class="footer-partner-wrapper">
  <h2>Our Partners</h2>
  <ul id="footer-partner-widget">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Partner Widgets') ) : ?>
    <?php endif; ?>
    <?php $partner_source = scandir(ECC_PARTNER_DIR);
	  if($partner_source)
	  {
		  foreach($partner_source as $key => $image):
		  
		  if($image == '.' || $image == '..'){continue;}
		  ?>
    <li><span style="display:table"><img style="display:table-cell;vertical-align:middle;" class="ecc-partner-image" src="<?php echo ECC_PARTNER_DIR_URI.'/'.$image?>" alt="partner"/></span></li>
    <?php
		  endforeach;
	  }
	  ?>
  </ul>
  <div class="separator"></div>
</div>
<?php endif;?>
