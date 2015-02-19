<?php
/*
Plugin Name: JNE Shipping Plugin
Plugin URI: 3marktech.com
Description: Your shipping method plugin
Version: 1.0.0
Author: Panji Tri Atmojo
Author URI: http://3marktech.com
*/

/**
 * Check if WooCommerce is active
 */
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    
    function ecc_jne_shipping_method_init()
    {
        if (!class_exists('WC_Ecc_Jne_Shipping_Method')) {
            class WC_Ecc_Jne_Shipping_Method extends WC_Shipping_Method
            {
                /**
                 * Constructor for your shipping class
                 *
                 * @access public
                 * @return void
                 */
                public function __construct()
                {
                    $this->id                 = 'ecc_shipping_method'; // Id for your shipping method. Should be uunique.
                    $this->method_title       = __('JNE Shipping'); // Title shown in admin
                    $this->method_description = __('Description of your shipping method'); // Description shown in admin
                    
                    $this->enabled = "yes"; // This can be added as an setting but for this example its forced enabled
                    $this->title   = "JNE Shipping"; // This can be added as an setting but for this example its forced.
                    
                    $this->init();
                }
                
                /**
                 * Init your settings
                 *
                 * @access public
                 * @return void
                 */
                function init()
                {
                    // Load the settings API
                    $this->init_form_fields();
                    $this->init_settings();
                    
                    // Save settings in admin if you have any defined
  
                    add_action('woocommerce_update_options_shipping_' . $this->id, array(
                        $this,
                        'process_admin_options'
                    ));
                    
                }
                
                
                function init_form_fields()
                {
                    
                    $this->form_fields = array(
                        'enabled' => array(
                            'title' => __('Enable/Disable', 'woocommerce'),
                            'type' => 'checkbox',
                            'label' => __('Enable JNE Shipping', 'woocommerce'),
                            'default' => 'yes'
                        ),
                        'title' => array(
                            'title' => __('Method Title', 'woocommerce'),
                            'type' => 'text',
                            'description' => __('This controls the title which the user sees during checkout.', 'woocommerce'),
                            'default' => __('JNE Shipping', 'woocommerce'),
                            'desc_tip' => true
                        ),
                        'availability' => array(
                            'title' => __('Method availability', 'woocommerce'),
                            'type' => 'select',
                            'default' => 'all',
                            'class' => 'availability',
                            'options' => array(
                                'all' => __('All allowed countries', 'woocommerce'),
                                'specific' => __('Specific Countries', 'woocommerce')
                            )
                        ),
                        'countries' => array(
                            'title' => __('Specific Countries', 'woocommerce'),
                            'type' => 'multiselect',
                            'class' => 'chosen_select',
                            'css' => 'width: 450px;',
                            'default' => '',
                            'options' => WC()->countries->get_shipping_countries(),
                            'custom_attributes' => array(
                                'data-placeholder' => __('Select some countries', 'woocommerce')
                            )
                        )
                    );
                    
                }
                
                /**
                 * calculate_shipping function.
                 *
                 * @access public
                 * @param mixed $package
                 * @return void
                 */
                public function calculate_shipping($package)
                {
				
				$weight = WC()->cart->cart_contents_weight;
				if($weight == 0)
				{
					$weight = WC()->cart->cart_contents_count;	
				}
				
				$shipping_cost_rate = 8000;
				
				$total_shipping = $weight * $shipping_cost_rate;
					
                    $rate = array(
                        'id' => $this->id,
                        'label' => $this->title,
                        'cost' => $total_shipping,
                        'calc_tax' => 'per_item'
                    );
                    
                    // Register the rate
                    $this->add_rate($rate);
                }
            }
        }	
		
    }
    
    add_action('woocommerce_shipping_init', 'ecc_jne_shipping_method_init');
    
    function add_ecc_jne_shipping_method($methods)
    {
        $methods[] = 'WC_Ecc_Jne_Shipping_Method';
        return $methods;
    }
    
    add_filter('woocommerce_shipping_methods', 'add_ecc_jne_shipping_method');
	
	add_filter( 'woocommerce_after_shipping_calculator' , 'ecc_jne_shipping_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function ecc_jne_shipping_checkout_fields( $fields ) {
     $fields['shipping']['shipping_city'] = array(
        'label'     => __('City', 'woocommerce'),
    'placeholder'   => _x('City', 'placeholder', 'woocommerce'),
    'required'  => true,
    'class'     => array('ecc-shipping-city'),
    'clear'     => true
     );
     $fields['shipping']['shipping_district'] = array(
        'label'     => __('Kecamatan', 'woocommerce'),
    'placeholder'   => _x('Kecamatan', 'placeholder', 'woocommerce'),
    'required'  => true,
    'class'     => array('ecc-shipping-kecamatan'),
    'clear'     => true
     );

     return $fields;
}


	add_action('ecc_additional_shipping_calculator_field', 'ecc_jne_field');
	
	function ecc_jne_field()
	{
		/**	add custom handler to save custom field data	**/
		if($_POST['calc_shipping'] == 1)
		{
			foreach($_POST as $key => $content)
			{
				if(preg_match('/^ecc\_.*$/', $key))
				{
					WC()->customer->$key = $content;
				}
			}

		}
		
		require(__DIR__.'/template/ecc-shipping-calculator.php');
	}

}
?>
