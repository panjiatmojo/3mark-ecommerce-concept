<?php
/**	class to convert xml into json	**/

class Ecc_Feed_To_Json
{
    public $feed;
    
    public static function get_json($feed)
    {
        /**	added conditional check to extract content inside CDATA tag	**/
        if (strpos($feed, '<![CDATA[')) {
            $file_content = preg_replace_callback('#<!\[CDATA\[(.*)\]\]>#', 'Ecc_Feed_To_Json::parseCDATA', str_replace("\n", " ", $feed));
        }
        /**	replace the new line and white space character	**/
        $file_content = str_replace(array(
            "\n",
            "\r",
            "\t"
        ), '', $feed);
        
        /**	replace double quote into single quote	**/
        $file_content = trim(str_replace('"', "'", $file_content));
        
        /**	create xml object from string	**/
        $simple_xml = simplexml_load_string($file_content, 'SimpleXMLElement', LIBXML_NOCDATA);
        
        /**	convert xml object into json object	**/
        $json = json_encode($simple_xml);
        
        return $json;
    }
    
    public static function parseCDATA($data)
    {
        return htmlentities($data[1]);
    }
    
}

?>