<?php
/**	Class to retrieve Facebook Feed via API	**/

class Ecc_Tumblr_Api
{
    /*	basic facebook api url	*/
    public $url = 'http://%s.tumblr.com/rss';
    /*	default return variable set to true	*/
    public $return = true;
   
    
	/*	get facebook feed based on user id	*/
    public function get_feed($username)
    {
        /*	create target url based on id	*/
        $url = sprintf($this->url, $username);
        
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