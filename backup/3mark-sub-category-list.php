<?php 
/**	only show sub-category if
1. category has sub-category
2. not default product category
3. have product category
**/
global $post;

if(
get_categories(array('parent' => wpsc_category_id(), 'taxonomy'=>'wpsc_product_category')) &&
get_option('wpsc_default_category') != wpsc_category_id() &&
wpsc_category_id() &&
(get_post_type() == ‘wpsc-product’  && !is_single())
) :?>

<li class="widget">
<h1 class="title"> <span><?php echo (get_option('3mark_word_sub_category')? get_option('3mark_word_sub_category'): "Sub-Category");?></span> </h1>
  <ul id="sub-category-widget">
  <?php 
//	only show sub-category if current category is not default category
wpsc_start_category_query(array('parent_category_id'=> wpsc_category_id(), 'show_thumbnails'=> get_option('show_category_thumbnails')))?>
  <li> <a href="<?php wpsc_print_category_url();?>" class="wpsc_category_link <?php wpsc_print_category_classes_section(); ?>" title="<?php wpsc_print_category_name(); ?>"><?php wpsc_print_category_name(); ?>
    </a> </li>
  <?php wpsc_end_category_query(); ?>
</ul>
<div class="separator"></div>
</li>
<?php endif; ?>