<?php if (function_exists('wpsc_start_category_query')) :?>

<li class="widget">
<h1 class="title"> <span><?php echo (get_option('3mark_word_category')?get_option('3mark_word_category'):"Category");?></span> </h1>
<ul id="category-widget">
  <?php wpsc_start_category_query(array('category_group'=>get_option('wpsc_default_category'), 'show_thumbnails'=> get_option('show_category_thumbnails'))); ?>
  <li> <a href="<?php wpsc_print_category_url();?>" class="wpsc_category_link <?php wpsc_print_category_classes_section(); ?>" title="<?php wpsc_print_category_name(); ?>"><?php wpsc_print_category_name(); ?>
    </a> </li>
  <?php wpsc_end_category_query(); ?>
</ul>
<div class="separator"></div>
</li>
<?php endif;?>