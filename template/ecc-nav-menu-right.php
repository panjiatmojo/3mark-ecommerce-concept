<?php 

$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'product_cat',
	'pad_counts'               => false 
); 

$category_array = get_categories($args);
$category_array = ecc_category_to_array($category_array);
	
	$menu_list = array(
	'about-us' => 'ABOUT US',
	'#' => '<form><input type="text" name="s" value="" placeholder="search"/><img src="'.get_template_directory_uri().'/images/ecc-kontainer-lup.png" class="ecc-lup"/></form>',
	'cart' => '<img src="'.get_template_directory_uri().'/images/ecc-shopping.png"/>',
	);
	
?>
<?php 
if (is_mobile()):
/**	if in mobile just show droppable small symbol **/
?>

<div class="menu-button">
  <div class="ecc-menu-logo-wrapper"><img class="ecc-menu-logo" width="30px" height="30px" src="<?php echo get_template_directory_uri().'/images/ecc-dropdown.png'?>"/></div>
</div>
<ul id="menus" class="flexnav" data-breakpoint="800">
  <?php
else:
?>
  <ul id="menus" class="flexnav" data-breakpoint="800">
    <?php
endif;
?>
    <?php foreach($menu_list as $slug => $content):?>
    <li><a href="<?php echo site_url().'/'.$slug; ?>">
      <?php _e($content);?>
      </a></li>
    <?php endforeach;?>
    <?php 
if (is_mobile()):
?>
  </ul>
  <?php
else:
?>
</ul>
<?php
endif;
?>