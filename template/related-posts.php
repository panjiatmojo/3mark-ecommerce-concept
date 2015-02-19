<?php 
/*
YARPP Template: the atmojo
Author: Panji Tri Atmojo 3Mark
Description: 3Mark theme for the atmojo
*/
?><h3>Related Posts</h3>
<?php if (have_posts()):?>
<ol>
	<?php while (have_posts()) : the_post(); ?>
	<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a><!-- (<?php the_score(); ?>)--></li>
	<?php endwhile; ?>
</ol>
<?php else: ?>
<p>No related posts.</p>
<?php endif; ?>
