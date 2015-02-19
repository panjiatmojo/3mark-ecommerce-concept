<?php

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

{

	die ('please do not load this page directly');

}

?>

<?php if(post_password_required()) : ?>



<p class="nocomments">This Post is password protected. Enter the password to view the comments.</p>

<?php return; ?>

<?php endif; ?>

<div id="comment-wrapper">

  <h3>

  <?php require('template/variables.php'); ?>

    <?php comments_number($no_comment_word, $single_comment_word, $multiple_comment_word);?>

  </h3>

  <?php

if(have_comments() || comments_open()) : ?>

  <a name="comments"></a>

  <div id="comments" class="section">

    <ol class="commentlist">

      <?php wp_list_comments('avatar_size=64&type=comment');?>

    </ol>

    <?php if ($wp_query->max_num_pages > 1) : ?>

    <div class="pagination">

      <ul>

        <li class="older">

          <?php next_posts_link("Older"); ?>

        </li>

        <li class="newer">

          <?php previous_posts_link("Newer"); ?>

        </li>

      </ul>

    </div>

    <?php endif; ?>

    <?php endif; ?>

    <?php if(comments_open()): ?>

    <?php  if(is_user_logged_in()) : 

	$current_user = wp_get_current_user();

	$name = $current_user->user_login;

	$email = $current_user->user_email;

	$url = $current_user->user_url;

	endif;

	?>

    <div id="respond">

      <h3><?php require_once('template/variables.php'); echo $leave_response_word;?></h3>

      <form action="<?php echo get_option('siteurl');?>/wp-comments-post.php" method="post" id="commentform">

        <fieldset>

        <label for="author">Name*</label>

        <input type="text" name="author" id="author" value="<?php if($name): echo $name; endif;?>" />

        <label for="email">Email*</label>

        <input type="text" name="email" id="email" value="<?php if($email): echo $email; endif;?>" />

        <label for="url">Website</label>

        <input type="text" name="url" id="url" value="<?php if($url): echo $url; endif;?>" />

        <label for="comment">Message</label>

        <textarea name="comment" id="comment" rows="5"></textarea>

        <input type="submit" class="button" value="SUBMIT"/>

        <?php comment_id_fields(); ?>

        <?php do_action('comment_form', $post->ID); ?>

      </form>

      <?php if( get_cancel_comment_reply_link()) :?>

      <p class="cancel">

        <?php cancel_comment_reply_link('Cancel'); ?>

      </p>

      <?php endif;?>

    </div>

    <?php else : ?>

    <h3><?php require_once('template/variables.php'); echo $comments_close_word;?></h3>

    <?php endif; ?>

  </div>

</div>

