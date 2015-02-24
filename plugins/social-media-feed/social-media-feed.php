<?php
define('ECC_SOCIAL_FEED_URL', get_file_url( __FILE__ ));
define('ECC_SOCIAL_FEED_DIR', plugin_dir_path( __FILE__ ));

require_once('ecc-feed.class.php');

add_action('wp_ajax_nopriv_ecc_update_feed', 'update_feed_ajax'); 
add_action('wp_ajax_ecc_update_feed', 'update_feed_ajax'); 

function update_feed_ajax()
{
	$last_date = esc_attr($_POST['last_date']);
	$service = esc_attr($_POST['service']);
	$limit = esc_attr($_POST['limit']);
	$username = esc_attr(get_option('ecc_' . $_POST['service'] . '_name'));
	
	Ecc_Feed::update_feed($service, $username, $limit, $last_date);
	
	die();			
}

?>