<?php
/**	class for ecc social media feed	**/

class Ecc_Feed
{
    
    /**	this function will return json object with content detail depend on each API	**/
    public static function get_feed($service, $username, $limit)
    {
        switch ($service) {
            case "facebook":
                                require_once(__DIR__ . '/ecc-facebook-api.class.php');
                $facebook = new Ecc_Facebook_Api;
                $user_id  = $facebook->get_user_id($username);
                $xml      = $facebook->get_feed($user_id);
                
                
                /**	convert xml to json object	**/
                require_once(__DIR__ . '/ecc-feed-to-json.class.php');
                $result = Ecc_Feed_To_Json::get_json($xml);
                $json   = json_decode($result);
                $json   = $json->channel->item;
               			
                /**	return json object with limited number of feed	**/
                return Ecc_Feed::limit_feed($json, $limit);
				                
                break;
            case "twitter":
                
                require_once(__DIR__ . '/ecc-twitter-api.class.php');
                /**	return json object with limited number of feed	**/
                $getfield      = sprintf('?screen_name=%s&count=%s', $username, $limit);
                $requestMethod = 'GET';
                
                $twitter      = new Ecc_Twitter_Api();
                $twitter_feed = $twitter->setGetfield($getfield)->buildOauth($requestMethod)->performRequest();
                $json         = json_decode($twitter_feed);
                
                return $json;
                break;
            
            case "tumblr":
                require_once(__DIR__ . '/ecc-tumblr-api.class.php');
                $tumblr = new Ecc_Tumblr_Api;
                $xml    = $tumblr->get_feed($username);
                
                /**	convert xml to json object	**/
                require_once(__DIR__ . '/ecc-feed-to-json.class.php');
                $result = Ecc_Feed_To_Json::get_json($xml);
                $json   = json_decode($result);
                $json   = $json->channel->item;
                
                /**	return json object with limited number of feed	**/
                return Ecc_Feed::limit_feed($json, $limit);
                break;
            
            case "instagram":
                
                break;
            
            case "path":
                
                break;
        }
    }
    
    public static function limit_feed($feed_json, $limit)
    {
        /**	initialize counter from zero	**/
        $counter = 0;
        
        /**	iterate over json feed and limit maximum feed	**/
        foreach ($feed_json as $key => $content) {
            /**	if counter less than limit then proceed	**/
            if ($counter < $limit) {
                $result[$key] = $content;
                $counter++;
            } else {
                /**	if counter equal or larger than limit then break	**/
                break;
            }
        }
        
        return $result;
    }
    
    public static function show_title($title)
    {
        if ($title instanceof stdClass) {
            echo "";
        } else {
            echo $title;
        }
        
    }
    
    public static function remove_image($content)
    {
        $content = preg_replace('/\<img.*?\/\>/i', '', $content);
        return $content;
    }
    
    public static function remove_space($content)
    {
        $content = preg_replace('/(\<br\>)+/i', '<br>', $content);
        $content = preg_replace('/\s+/i', ' ', $content);
        return $content;
    }
    
    public static function show_description($content)
    {
        //$content = Ecc_Feed::remove_image($content);
        $content = Ecc_Feed::remove_space($content);
        
        echo $content;
    }
   
    public static function show_feed($service, $username, $limit)
    {
        $json_feed = Ecc_Feed::get_feed($service, $username, $limit);
		include(__DIR__.'/template/ecc-feed-container.php');
    }

    public static function show_feed_container($service, $username, $limit)
    {
		/**	create container only, feed update will be done via ajax	**/
		include(__DIR__.'/template/ecc-feed-container.php');
		
		/**	load script to do ajax feed loading	**/
		wp_register_script( 'ecc-init-feed', ECC_SOCIAL_FEED_URL.'library/js/ecc-init-feed.js', 'jquery', '1.0.0', false);

		/**	localize sript with additional data	**/
		$global_array = array(
			'base_url' => site_url()
		);
		wp_localize_script( 'ecc-init-feed', 'global_variable', $global_array );
		
		wp_enqueue_script( 'ecc-init-feed' );
		
		wp_enqueue_style('ecc-feed', ECC_SOCIAL_FEED_URL.'library/css/ecc-feed.css', "", '1.0.0', false);
    }
	
    public static function update_feed($service, $username, $limit, $last_id)
    {
        $json_feed = Ecc_Feed::get_feed($service, $username, $limit);
        
        foreach ($json_feed as $key => $content) {
            include(__DIR__ . '/template/ecc-feed-list.php');
        }
    }
}



?>