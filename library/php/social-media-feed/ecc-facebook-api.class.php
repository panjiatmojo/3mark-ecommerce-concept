<?php
/**	Class to retrieve Facebook Feed via API	**/

class Ecc_Facebook_Api
{
    /*	basic facebook api url	*/
    public $url = 'https://www.facebook.com/feeds/page.php?format=rss20&id=%s';
    /*	facebook url to retrieve user id based on name	*/
    public $id_url = 'https://graph.facebook.com/%s';
    /*	default return variable set to true	*/
    public $return = true;
    
	/*	method to retrieve user id from provided username	*/
    public function get_user_id($username)
    {
        /*	create target url based on id	*/
        $url = sprintf($this->id_url, $username);
        
        /*	create options array for curl request	*/
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36'
        );
        
        $feed = curl_init();
        curl_setopt_array($feed, $options);
        $json = curl_exec($feed);
        curl_close($feed);
        
        if ($json) {
            $result_array = json_decode($json, true);
            if (@$result_array['id']) {
                $user_id = $result_array['id'];
            } else {
                $user_id = 0;
            }
        }
        
        if ($user_id) {
            return $user_id;
        }
    }
    
	/*	get facebook feed based on user id	*/
    public function get_feed($id)
    {
        /*	create target url based on id	*/
        $url = sprintf($this->url, $id);
        
        /*	create options array for curl request	*/
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36'
        );
        
        $feed = curl_init();
        curl_setopt_array($feed, $options);
        $xml = curl_exec($feed);
        curl_close($feed);
        if ($this->return) {
            return $xml;
        }
    }
    
}