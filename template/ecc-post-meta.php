<ul class="post-meta">

      <!-- show post meta data-->

      <?php require('variables.php'); ?>

      <li><?php //echo $posted_by_word; ?>

        <?php the_author();?>

      </li>

      <li><?php //echo $at_time_word; ?>@

        <?php the_time('F jS, Y');?>

      </li>

      <li>

        <?php the_category(','); ?>

      </li>

      <li><a href="<?php the_permalink() ?>#comments"><?php comments_number($no_comment_word, $single_comment_word, $multiple_comment_word); ?></a>

      </li>
      <div style="clear:both"></div>

    </ul>