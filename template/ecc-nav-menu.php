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
	0 => array('url' => '', 'content' => 'PRODUCTS', 'class' => '', 'link' => true,'child' => $category_list),
	1 => array('url' => 'features', 'content' => 'FEATURES', 'class' => ''),
	2 => array('url' => 'connect', 'content' => 'CONNECT', 'class' => ''),
	3 => array('url' => '', 'content' => '<img class="banner-logo" src="'.get_option('ecc_website_logo').'" />', 'class' => 'double-width', 'mobile' => false, ),
	4 => array('url' => 'about-us', 'content' => 'ABOUT US', 'class' => ''),
	5 => array('url' => '#', 'content' => '<form action="'.site_url().'"><input type="text" name="s" value="" placeholder="search"/><img src="'.get_template_directory_uri().'/images/ecc-kontainer-lup.png" class="ecc-lup"/></form>', 'class' => '', 'link' => false),
	6 => array('url' => 'cart', 'content' => '<img src="'.get_template_directory_uri().'/images/ecc-shopping.png"/>', 'class' => ''),

	);

/**	function to create menu based on args	**/	
function create_nav_menu($args)
{
	global $menu_list;
	
	$menu_list = $args;
	get_template_part('template/ecc', 'nav-menu-content');
}
	
?>

<div class="mobile-logo"><a href="<?php echo site_url().'/'.$content['url']; ?>"><img src="<?php echo get_option('ecc_website_mobile_logo');?>"/></a></div>
<?php create_nav_menu($menu_list);?>
