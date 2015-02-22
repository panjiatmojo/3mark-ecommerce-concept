<?php

/**
 * @package Akismet
 */
/*
Plugin Name: 3MARK Image Loader
Plugin URI: http://theatmojo.com/
Description: Responsive image loader 
Version: 1.0.0
Author: Panji Tri Atmojo
Author URI: http://theatmojo.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: 3MARK
*/

define('ECC_IMAGE_LOADER_URL', plugin_dir_url( __FILE__ ));
define('ECC_IMAGE_LOADER_DIR', plugin_dir_path( __FILE__ ));

/**	add action to handle ajax request for image loader	**/
add_action('wp_ajax_nopriv_ecc_image_loader', 'ecc_ajax_get_image_url');
add_action('wp_ajax_ecc_image_loader', 'ecc_ajax_get_image_url');

/**	ajax handler to get the most appropriate image based on url and size	**/
function ecc_ajax_get_image_url()
{
	global $_POST;
	
	$parameter = $_POST;
		
	if($result['url'] = ecc_get_image_url($parameter))
	{
		echo json_encode($result);	
	};
	
	die();
}

/**	function to get the optimum size of image	**/
function ecc_get_image_url($parameter)
{
	global $wpdb;
	
	/**	match the filename and extension	**/
	preg_match('/^.*\/(.*?)$/', $parameter['url'], $url);
	
	/**	get the filename only	**/
	$image_url = $url[1];
	
	/**	get the required size parameter	**/
	$image_size = $parameter['size'];
	
	/**	create query to get the post id of given image url	**/
	$query = sprintf("SELECT * FROM `%s` WHERE guid LIKE '%%\/%s.%%'", $wpdb->posts, $image_url);
				
	/**	execute the query	**/			
	$image_info = $wpdb->get_row( $query );
	
	/**	extract the post id	**/	
	$image_id = $image_info->ID;
	
	/**	get the image source with respective image size	**/
	$image_src = wp_get_attachment_image_src($image_id, array($image_size, $image_size));
	
	/**	return url part of the source	**/
	return $image_src[0];
}

if (get_option('ecc_image_loader_product_enable')): /**	add content filtering to header single product page	**/ 
    add_action('ecc_single_page_before', 'ecc_filter_content_start', 1);
    add_action('ecc_single_page_after', 'ecc_filter_content_end', 100);
endif;

if (get_option('ecc_image_loader_page_enable')): /**	add content filtering to page header	**/ 
    add_action('ecc_page_before', 'ecc_filter_content_start', 1);
    add_action('ecc_page_after', 'ecc_filter_content_end', 100);
endif;

if (get_option('ecc_image_loader_index_enable')): /**	add content filtering to index header	**/ 
    add_action('ecc_index_before', 'ecc_filter_content_start', 1);
    add_action('ecc_index_after', 'ecc_filter_content_end', 100);
endif;

if (get_option('ecc_image_loader_search_enable')): /**	add content filtering to search header	**/ 
    add_action('ecc_search_before', 'ecc_filter_content_start', 1);
    add_action('ecc_search_after', 'ecc_filter_content_end', 100);
endif;

if (get_option('ecc_image_loader_single_enable')): /**	add content filtering to single header	**/ 
    add_action('ecc_single_before', 'ecc_filter_content_start', 1);
    add_action('ecc_single_after', 'ecc_filter_content_end', 100);
endif;


/**	create content intercept using ob start	**/
function ecc_filter_content_start()
{
    ob_start();
}

/**	output content intercept using ob clean	**/
function ecc_filter_content_end()
{
	/**	retrieve the result	**/
    $result = ob_get_contents();
    
    ob_end_clean();
    
    $result = apply_filters('ecc_filter_content', $result);
    
    echo $result;
}


/**	attach image loader to content hook	**/
if (get_option('ecc_image_loader_enable') == true) {
    add_filter('ecc_filter_content', 'ecc_filter_image', 100);
    function ecc_filter_image($content)
    {
        require_once(ECC_IMAGE_LOADER_DIR.'/ecc-image-loader.class.php');
        return Ecc_Image_Loader::filter_image($content);
    }
}


?>