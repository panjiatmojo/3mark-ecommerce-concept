<div class="editing-tools">
  <?php
	global $edit_post_content, $delete_post_content;
	if ( current_user_can('edit_post') ) :
	?>
  <div class="edit-button button"><a href="<?php echo get_edit_post_link(  );?>" target="_blank"><?php echo $edit_post_content;?></a></div>
  <?php endif;
 	if ( current_user_can('delete_post') ) :
	?>
  <div class="delete-button button"><a href="<?php echo get_delete_post_link(  );?>" target="_blank"><?php echo $delete_post_content;?></a></div>
  <?php endif;?>
</div>
