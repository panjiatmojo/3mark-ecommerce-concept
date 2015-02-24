<div class="ecc-feed container <?php _e($service);?>">
  <input type="hidden" name="last-feed <?php _e($service);?>" value=""/>
  <input type="hidden" name="username" value="<?php _e($username);?>"/>
  <input type="hidden" name="service" value="<?php _e($service);?>"/>
  <input type="hidden" name="limit" value="<?php _e($limit);?>"/>
  <ul>
    <?php
	if($json_feed): 
foreach ($json_feed as $key => $content) {
	include(__DIR__ . '/ecc-feed-list.php');
}
endif;
?>
  </ul>
</div>
