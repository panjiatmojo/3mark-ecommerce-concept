<?php
/**	template to show features and products based on custom field	**/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce_loop;

woocommerce_wp_textarea_input( 
	array( 
		'id'          => 'compatibility', 
		'label'       => __( 'Compatiblity', 'woocommerce' ), 
		'placeholder' => '', 
		'description' => __('List gadgets compatiblity with the product', 'woocommerce' ) 
	)
);

woocommerce_wp_textarea_input( 
	array( 
		'id'          => 'material', 
		'label'       => __( 'Material', 'woocommerce' ), 
		'placeholder' => '', 
		'description' => __( 'What kind of material used', 'woocommerce' ) 
	)
);

woocommerce_wp_textarea_input( 
	array( 
		'id'          => 'storage', 
		'label'       => __( 'Storage', 'woocommerce' ), 
		'placeholder' => '', 
		'description' => __( 'List of available container', 'woocommerce' ) 
	)
);




?>