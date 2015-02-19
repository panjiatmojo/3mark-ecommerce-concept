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

foreach($category_array as $key => $content)
{
	$category_list .= '<li>'.$content['name'].'</li>';	
}

$category_list = '<ul>'.$category_list.'</ul>';
	
	$menu_list = array(
	0 => array('url' => '', 'content' => 'PRODUCTS', 'class' => '', 'link' => true, 'child' => $category_list),
	1 => array('url' => 'features', 'content' => 'FEATURES', 'class' => ''),
	2 => array('url' => 'connect', 'content' => 'CONNECT', 'class' => ''),
	3 => array('url' => '', 'content' => '<img class="banner-logo" src="'.get_option('ecc_website_logo').'" />', 'class' => 'double-width'),
	4 => array('url' => 'about-us', 'content' => 'ABOUT US', 'class' => ''),
	5 => array('url' => '#', 'content' => '<form action="'.site_url().'"><input type="text" name="s" value="" placeholder="search"/><img src="'.get_template_directory_uri().'/images/ecc-kontainer-lup.png" class="ecc-lup"/></form>', 'class' => '', 'link' => false),
	6 => array('url' => 'cart', 'content' => '<img src="'.get_template_directory_uri().'/images/ecc-shopping.png"/>', 'class' => ''),

	);
	
?>
<div class="mobile-logo"><a href="<?php echo site_url().'/'.$content['url']; ?>"><img src="<?php echo get_option('ecc_website_mobile_logo');?>"/></a></div>
<div class="menu-button">
  <div class="ecc-menu-logo-wrapper"><img class="ecc-menu-logo" width="30px" height="30px" src="<?php echo get_template_directory_uri().'/images/ecc-dropdown-black.png'?>"/></div>
</div>
<ul id="menus" class="flexnav" data-breakpoint="1280">
    <?php foreach($menu_list as $slug => $content):?>
    <li <?php echo ($content['class'])? 'class="' . $content['class'] . '"':'';?>> 
      <?php if($content['link'] === false):?>
      <span><?php _e($content['content']);?></span>
      <?php else:?>
      <a href="<?php echo site_url().'/'.$content['url']; ?>"><?php _e($content['content']);?> </a>
      <?php endif;?>
      <?php echo ($content['child']) ? $content['child'] : "";?> 
    </li>
    <?php endforeach;?>
</ul>
