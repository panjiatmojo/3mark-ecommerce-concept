<?php
/**	class for ecc social media feed	**/

class Ecc_Image_Loader
{
	public static function filter_image($content)
	{
		$image_size_array = Ecc_Image_Loader::get_image_sizes();
	
		$image_size_string = "";

		/**	create string of available image size	**/
		foreach($image_size_array as $key => $info)
		{
			if($info['crop'] == false)
			{
				$image_size_string .= $info['width'].'x'.$info['height'].'x'.$info['crop'].';';	
			}
		}
	
		/**	get all image tag and replace image src with loading symbol **/
		$result = preg_replace('/<img(.*)src=(\"|\')(.*?)(\"|\')(.*)\/>/', 
		'<img$1src="'.get_option('ecc_image_loader_logo').'"$5 image-src="$3" image-size="'.$image_size_string.'"/>', $content); 
		
		/**	get all image tag and add ecc-image-loader class	**/
		$result = preg_replace('/<img(.*)class=(\"|\')(.*?)(\"|\')(.*)\/>/', 
		'<img$1class="$3 ecc-image-loader"$5/>', $result); 
		
		/**	load script to do lazy load	**/
		wp_enqueue_script('ecc-init-image-loader', get_template_directory_uri().'/library/php/image-loader/library/js/ecc-init-image-loader.js', 'jquery' ,'1.0.0', false);	
		/**	load style to support image loader	**/
		wp_enqueue_style('ecc-image-loader', get_template_directory_uri().'/library/php/image-loader/library/css/ecc-image-loader.css', array() ,'1.0.0');	
				
		return $result;
	}
	
	public static function get_image_sizes( $size = '' ) {

        global $_wp_additional_image_sizes;

        $sizes = array();
        $get_intermediate_image_sizes = get_intermediate_image_sizes();

        // Create the full array with sizes and crop info
        foreach( $get_intermediate_image_sizes as $_size ) {

                if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

                        $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
                        $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
                        $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

                } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

                        $sizes[ $_size ] = array( 
                                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
                        );

                }

        }

        // Get only 1 size if found
        if ( $size ) {

                if( isset( $sizes[ $size ] ) ) {
                        return $sizes[ $size ];
                } else {
                        return false;
                }

        }

        return $sizes;
}
	
}



?>