<?php

/**

ecc stands for emark commerce concept

**/

require("template/variables.php");
require('library/plugin/ecc-jne-shipping/ecc-jne-shipping.php');

global $query_reference;

define('ECC_THEME_HOME_DIR', __DIR__);
define('ECC_IMAGE_URI', get_template_directory_uri() . '/images/');
define('ECC_PARTNER_DIR', ECC_THEME_HOME_DIR . '/images/partner/');
define('ECC_PARTNER_DIR_URI', get_template_directory_uri() . '/images/partner/');

add_action('after_setup_theme', 'ecc_theme_setup');

function ecc_theme_setup()
{
    //	remove the generator meta tag
    remove_action('wp_head', 'wp_generator');
    
    //	add theme support here
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'ecc_measure_loading');

function ecc_measure_loading()
{
    global $ecc_start_time;
    
    $ecc_start_time = microtime(true);
}

function ecc_get_loading_time()
{
    global $ecc_start_time;
    
    return number_format(microtime(true) - $ecc_start_time, 3);
}

function ecc_show_loading_time()
{
    echo __('Loading Time') . ' ' . ecc_get_loading_time();
    return;
}

/**
 * Register our sidebars and widgetized areas.
 *
 */
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Footer Partner Widgets',
        'id' => 'footer-partner-widget',
        'description' => 'Footer Partner Widget Area',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
        'name' => 'Footer Left Widgets',
        'id' => 'left-widget',
        'description' => 'Footer Left Widget Area',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
        'name' => 'Footer Center Widgets',
        'id' => 'center-widget',
        'description' => 'Footer Center Widget Area',
        'before_widget' => '<li class="widget">',
        'after_widget' => '</li>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
        'name' => 'Footer Right Widgets',
        'id' => 'right-widget',
        'description' => 'Footer Right Widget Area',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
        'name' => 'Sidebar Widgets',
        'id' => 'sidebar-widget',
        'description' => 'Sidebar Widget Area',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
}

/**	add custom rupiah currency	**/

add_filter('woocommerce_currencies', 'add_my_currency');
function add_my_currency($currencies)
{
    $currencies['IDR'] = __('Rupiah', 'woocommerce');
    return $currencies;
}

/**	add custom rupiah symbol	**/
add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
function add_my_currency_symbol($currency_symbol, $currency)
{
    switch ($currency) {
        case 'IDR':
            $currency_symbol = 'IDR ';
            break;
    }
    return $currency_symbol;
}

add_filter('wp_title', 'ecc_modify_title');

function ecc_modify_title($title)
{
    if (empty($title) && (is_home() || is_front_page())) {
        return get_bloginfo('title') . ' | ' . get_bloginfo('description');
    } else if (is_single() || is_page()) {
        return $title . ' ' . get_bloginfo('title');
    }
    return $title;
}

/**	remove existing hook for content-product template	**/
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash');
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating');
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
/**	remove woocommerce product count result	**/
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

/**	remove woocommerce default pagination	**/
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination');

/**	create add to hook for template wrapping	**/
add_action('woocommerce_before_main_content', 'ecc_add_page_container_before', 1);
add_action('woocommerce_after_main_content', 'ecc_add_page_container_after', 1);

/**	add editing tools before single product main content	**/
/*add_action( 'woocommerce_before_single_product', 'ecc_get_pagination', 1);*/

/**	add editing tools before single product main content	**/
add_action('woocommerce_before_single_product', 'ecc_get_editing', 2);

/**	add pagination and editing tools after single product main content	**/
/*add_action( 'woocommerce_before_shop_loop', 'ecc_get_pagination', 40);*/

function ecc_add_page_container_before()
{
    if (is_single() && get_post_type() == 'product') {
        get_template_part('template/ecc', 'single-page-before');
    } else {
        get_template_part('template/ecc', 'page-before');
    }
}

function ecc_add_page_container_after()
{
    if (is_single() && get_post_type() == 'product') {
        get_template_part('template/ecc', 'single-page-after');
    } else {
        get_template_part('template/ecc', 'page-after');
    }
}

/**	add functionality to show banner above product category page	**/
/**	banner is shown before category title	**/
add_action('woocommerce_before_main_content', 'ecc_category_image', 40);
function ecc_category_image()
{
    if (is_product_category()) {
        global $wp_query;
        $cat          = $wp_query->get_queried_object();
        $thumbnail_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true);
        $image        = wp_get_attachment_url($thumbnail_id);
        if ($image) {
            echo '<img src="' . $image . '" alt="" />';
        }
    }
}
/**	add new label for **/
add_action( 'woocommerce_product_thumbnails', 'ecc_new_label');

function ecc_new_label()
{
	get_template_part('template/product/ecc', 'product-new-label');
}

/**	remove breadcrumb from product category page	**/
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/**	modify the content of single product page	**/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 8);

/**	modify the additional category meta after single product title	**/
function ecc_after_title_meta()
{
    global $product;
    echo $product->get_categories(' ', '<div class="category-after-title">', '</div>');
}
add_action('woocommerce_single_product_summary', 'ecc_after_title_meta', 6);

/**	add new color information based on product attribute	**/
function ecc_product_color()
{
    global $product;
    if ($color = $product->get_attribute('color')) {
        $color       = $product->get_attribute('color');
        $color_array = explode(' | ', $color);
        
        $output = '<div class="product-color-wrapper"><div class="product-color">';
        
        foreach ($color_array as $key => $content) {
            $output .= sprintf("<span class='product-color-single %s'>%s</span>", strtolower($content), $content, $content);
        }
        
        $output .= '</div></div>';
        echo $output;
        
    }
}
add_action('woocommerce_single_product_summary', 'ecc_product_color', 9);

/**	remove meta from single product	**/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

/**	add feature & specs section	**/
function ecc_product_feature()
{
	global $product, $post;
	get_template_part('template/product/ecc','product-feature');		
}
add_action('woocommerce_after_single_product_summary',  'ecc_product_feature', 5);

/**	add product review section	**/
function ecc_product_review()
{
	global $product, $post;
	get_template_part('template/product/ecc','product-review');		
}
add_action('woocommerce_after_single_product_summary',  'ecc_product_review', 6);

/**	add new custom type product attribute	**/
/**	add custom attribute fields	**/
add_action( 'woocommerce_product_options_general_product_data', 'ecc_add_custom_general_fields' );

/**	add save custom attribute fields function	**/
add_action( 'woocommerce_process_product_meta', 'ecc_add_custom_general_fields_save' );

/**	add custom attribute fields	**/
function ecc_add_custom_general_fields() {
 
  global $woocommerce, $post;
  get_template_part('template/product/ecc', 'product-meta');
}
/**	add save custom attribute fields function	**/
function ecc_add_custom_general_fields_save( $post_id ){
	
	$value = $_POST['compatibility'];
	if( !empty( $value ) )
		update_post_meta( $post_id, 'compatibility', esc_attr( $value ) );	
	$value = $_POST['material'];
	if( !empty( $value ) )
		update_post_meta( $post_id, 'material', esc_attr( $value ) );	
	$value = $_POST['storage'];
	if( !empty( $value ) )
		update_post_meta( $post_id, 'storage', esc_attr( $value ) );	
}


/**	remove single product tab menu	**/
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);


/**	modify the add to cart text	**/
add_filter('woocommerce_product_single_add_to_cart_text', 'modify_text_add_to_cart');
add_filter('woocommerce_product_add_to_cart_text', 'modify_text_add_to_cart');

function modify_text_add_to_cart($content)
{
    if ($content == "Add to cart") {
        return "BUY";
    } elseif ($content == 'View Cart') {
        return "VIEW";
    } elseif ($content == 'Read more') {
        return "Read";
    } else {
        return $content;
    }
    
    
}

/**	function to show pagination	**/

function ecc_get_pagination()
{
    get_template_part('template/ecc', 'pagination');
}

/**	function to show editing tools **/
function ecc_get_editing()
{
    get_template_part('template/ecc', 'editing-tools');
}


// Create a function to view post as default query some categories from the main query

add_action('pre_get_posts', 'modify_default_post_type');

function modify_default_post_type($query)
{
    
    global $query_reference;
    
    // Check if on frontend and main query is modified
    if ($query->is_main_query() && !$query->get('post_type')) {
        
    }
    
    if ($query->is_main_query() && !$query->get('post_type')) {
        
    }
    
    if (($query->get('post_type') == 'product') && !is_front_page() && !is_admin()) {
        $query->set('posts_per_page', 9);
        $query->set('order', 'DESC');
    }
    
    $query_reference = $query;
}

/**	modify default excerpt wording	**/
function new_excerpt_more($more)
{
    return get_option('ecc_excerpt_read_more');
}
add_filter('excerpt_more', 'new_excerpt_more');

/**	modify default excerpt length	**/
function custom_excerpt_length($length)
{
    return get_option('ecc_excerpt_length');
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

function get_category_link_by_name($category = '')
{
    // Get the ID of a given category
    $category_id = get_cat_ID($category);
    
    // Get the URL of this category
    $category_link = get_category_link($category_id);
    return $category_link;
}

function get_device_type()
{
    //	function to check device type desktop, tablet or mobile
    $detect = new Mobile_Detect;
    $mobile = isset($_GET['mobile']) ? (int) htmlentities($_GET['mobile']) : '';
    
    echo $mobile;
    
    if ($mobile === 0) {
        //	if mobile parameter is set to 0
        return 'desktop';
    }
    if ($detect->isMobile()) {
        return 'mobile';
    } elseif ($detect->isTablet()) {
        return 'tablet';
    } else {
        return 'desktop';
    }
}

function emark_get_product_thumbnail_src($post_id)
{
    $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'product-thumbnails');
    return $thumbnail_src[0];
}

function emark_show_grid_product($input_array = array())
{
    /**	wrapper to show product in grid layout **/
    global $wp_query, $emark_product_grid_array;
    
    /**	load the product list	**/
    
    $input_array['category_name'] = ($input_array['category_name']) ? $input_array['category_name'] : 'Hot Item';
    $input_array['query_array']   = ($input_array['query_array']) ? $input_array['query_array'] : array();
    
    $emark_product_grid_array = $input_array;
    
    $wp_query = new WP_Query($input_array['query_array']);
    
    /**	load the template part	**/
    require('3mark-product-default.php');
    
    wp_reset_postdata();
    unset($emark_product_grid_array);
}

function emark_show_price($input_array = array())
{
    /**	function wrapper to add filter tinto existing wpsc_the_product_price_display function **/
    ob_start();
    wpsc_the_product_price_display($input_array);
    $input  = ob_get_clean();
    $output = apply_filters('price_filter', $input);
    echo $output;
}

/**	add snippet price filter into price filter **/
add_filter('price_filter', 'add_snippet_price');

function add_snippet_price($input)
{
    $pattern_get_old_price     = '/<span.+?oldprice.+?>[\w]{3}.+?([\d\.]+).+?<\/span>/';
    $pattern_get_current_price = '/<span.+?currentprice.+?>[\w]{3}.+?([\d\.]+).+?<\/span>/';
    $pattern_get_price         = '/(<span.+currentprice.+>[A-Z]{3}.+?)([\d\.\,]+)(<\/span>)/';
    $pattern_get_span_class    = '/(<span)(.+?)(class=.+?currentprice.+?>[\w]{3}.+?[\d\.\,]+<\/span>)/';
    $pattern_single_product    = '/<div.+?class=.+?(single_product_display)[\n\W\w]+?<\/div>/';
    
    $replacement_offer = '$1 itemprop="offers" itemscope itemtype="http://schema.org/Offer" $3';
    
    if (wpsc_product_has_stock()):
        $availability_tag = '<span itemprop="availability" content="http://schema.org/InStock"></span>';
    else:
        $availability_tag = '<span itemprop="availability" content="http://schema.org/SoldOut"></span>';
    endif;
    
    $replacement_price_tag = '$1<span itemprop="price">$2</span><span itemprop="priceCurrency" content="IDR"></span> ' . $availability_tag . ' $3';
    
    preg_match($pattern_get_old_price, $input, $old_price);
    $old_price = (float) str_replace('.', '', $old_price[1]); //	retrieve old price
    preg_match($pattern_get_current_price, $input, $current_price);
    $current_price = (float) str_replace('.', '', $current_price[1]); //	retrieve new price
    
    $input = preg_replace($pattern_get_price, $replacement_price_tag, $input);
    $input = preg_replace($pattern_get_span_class, $replacement_offer, $input);
    
    return $input;
}

function emark_product_rater()
{
    global $wpsc_query;
    $product_id = get_the_ID();
    $output     = '';
    if (get_option('product_ratings') == 1) {
        $output .= "<div class='product_footer'>";
        
        $output .= '<div class="product_average_vote" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
        /*$output .= "<strong>" . __( 'Avg. Customer Rating', 'wpsc' ) . ":</strong>";*/
        $output .= "<strong>" . __('Product Rating', 'wpsc') . ":</strong>";
        $output .= emark_product_existing_rating($product_id);
        $output .= "</div>";
        
        $output .= "<div class='product_user_vote'>";
        
        $output .= "<strong><span id='rating_" . $product_id . "_text'>" . __('Your Rating', 'wpsc') . ":</span>";
        $output .= "<span class='rating_saved' id='saved_" . $product_id . "_text'> " . __('Saved', 'wpsc') . "</span>";
        $output .= "</strong>";
        
        $output .= wpsc_product_new_rating($product_id);
        $output .= "</div>";
        $output .= "</div>";
    }
    return $output;
}


function emark_product_existing_rating($product_id)
{
    global $wpdb;
    $get_average = $wpdb->get_results($wpdb->prepare("SELECT AVG(`rated`) AS `average`, COUNT(*) AS `count` FROM `" . WPSC_TABLE_PRODUCT_RATING . "` WHERE `productid`= %d ", $product_id), ARRAY_A);
    
    $average = ($get_average[0]['average']) ? number_format($get_average[0]['average'], 1) : 0;
    $count   = $get_average[0]['count'];
    
    /*$average = floor( $get_average[0]['average'] );
    $count = $get_average[0]['count'];*/
    
    $output = "<span class='votetext'>
	<span itemprop='ratingValue'> $average&nbsp;</span>/&nbsp;5</span>";
    
    /*
    for ( $l = 1; $l <= $average; ++$l ) {
    $output .= "<img class='goldstar' src='" . WPSC_CORE_IMAGES_URL . "/gold-star.png' alt='$l' title='$l' />";
    }
    $remainder = 5 - $average;
    for ( $l = 1; $l <= $remainder; ++$l ) {
    $output .= "<img class='goldstar' src='" . WPSC_CORE_IMAGES_URL . "/grey-star.png' alt='$l' title='$l' />";
    }*/
    $output .= "<span class='vote_total'> from <span id='vote_total_{$product_id}' itemprop='reviewCount'>" . $count . "</span> Reviewers</span> \r\n";
    //$output .= "</span> \r\n";
    return $output;
}




function get_editing_tools()
{
    load_template(get_template_directory() . '/template/ecc-editing-tools.php', false);
}

function get_read_more()
{
    global $read_more_word;
    echo '<div class="read-more"><a href="' . htmlentities(get_permalink()) . '">' . $read_more_word . '</a></div>';
}

function is_mobile()
{
    if (get_view_type() == 'mobile') {
        return true;
    }
}

function get_view_type()
{
    $detect = new Mobile_Detect;
    
    if (isset($_GET['mobile'])) {
        $mobile_view = $_GET['mobile'];
        
        if ($mobile_view == '1') {
            return 'mobile';
        } elseif ($mobile_view == '0') {
            return 'desktop';
        }
    } else {
        if ($detect->isTablet()) {
            return 'desktop';
        } elseif ($detect->isMobile()) {
            return 'mobile';
        }
    }
}

function get_content_snippet($words)
{
    global $read_more_word;
    
    $content = get_the_content();
    
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = preg_replace("/<img[^>]+\>/i", "", $content);
    $content = strip_tags($content);
    
    $content = get_snippet($content, $words) . '...';
    
    return $content;
}

function get_image_replacement()
{
    $content = get_post_field('post_content', get_the_ID());
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = preg_replace("/<img[^>]+\>/i", "", $content);
    $content = strip_tags($content);
    $content = get_snippet($content, 100) . '...';
    
    $content = ($content) ? '"' . $content . '"' : $content;
    
    $image = '<span class="image-replacement">' . $content . '</span>';
    
    return $image;
}

function get_last_thumbnail($category = '')
{
    $count = 1;
    if ($category != '') {
        query_posts(array(
            'category_name' => $category
        ));
        
        while (have_posts() && $count > 0):
            the_post();
            if (get_content_thumbnail($category)) {
                echo get_content_thumbnail($category);
                wp_reset_query();
                return;
            }
            $count--;
        endwhile;
        
        echo get_image_replacement();
        wp_reset_query();
    }
}

function get_content_thumbnail($category = '', $url = 0)
{
    $panorama_view = 0;
    //	get the first more than 100px picture from post content
    if ($category != '') {
        if (!in_category($category)) {
            return;
        }
    }
    
    $content = get_the_content();
    
    $doc = new DOMDocument();
    @$doc->loadHTML($content);
    
    $tags = $doc->getElementsByTagName('img');
    
    foreach ($tags as $tag) {
        $image  = $tag->getAttribute('src');
        $filter = "/\.(jpg|jpeg|gif|png)/i"; // only allow specific set format of picture to avoid malicious file upload
        
        if (!preg_match($filter, $image)) {
            //	check if extension are allowed, break if not allowed
            break;
        }
        
        $dim = get_image_dim($tag);
        
        if ($dim['width'] > '100') {
            
            if ($dim['ratio'] < 1) {
                $height     = 'auto';
                $max_height = '60%';
                $width      = 'auto';
                $max_width  = '100%';
            } else if ($dim['ratio'] <= 1.6) {
                $height     = 'auto';
                $max_height = 'none';
                $width      = 'auto';
                $max_width  = '100%';
                
            } else if ($dim['ratio'] > 1.6 && $dim['ratio'] <= 2) {
                $height     = 'auto';
                $max_height = 'none';
                $width      = '100%';
                $max_width  = '100%';
                
            } else if ($dim['ratio'] > 2) {
                if ($dim['height'] >= '400') {
                    $panorama_view = 1;
                    $height        = $dim['height'];
                } else {
                    $height     = 'auto';
                    $max_height = 'none';
                    $width      = '100%';
                    $max_width  = '100%';
                }
            }
            break;
        }
    }
    if ($image) {
        if ($url == 1) {
            $image = $image;
        } else {
            if ($panorama_view == 1) {
                $image = '<div class="panorama-view" style="background:url(' . $image . ');background-size:cover;background-position:50% 50%;max-width:100%;max-height:600px;height:0px"></div>';
            } else {
                $image = '<img src="' . $image . '" style="width:' . $width . ';height:' . $height . ';max-height:' . $max_height . ';max-width:' . $max_width . '"/>';
            }
        }
    } else {
        $image = null;
    }
    return $image;
}

function get_postmeta()
{
    load_template(get_template_directory() . '/template/ecc-post-meta.php', false);
}

function get_snippet($str, $wordCount = 10)
{
    return implode('', array_slice(preg_split('/([\s,\.;\?\!]+)/', $str, $wordCount * 2 + 1, PREG_SPLIT_DELIM_CAPTURE), 0, $wordCount * 2 - 1));
}

function sibling_post_link($format = '%link &raquo;', $link = '%title', $in_same_cat = false, $excluded_categories = '', $previous = true)
{
    if ($previous && is_attachment())
        $post = get_post(get_post()->post_parent);
    else
        $post = get_adjacent_post($in_same_cat, $excluded_categories, $previous);
    
    if (!$post) {
        $output = '';
    } else {
        $title = $post->post_title;
        
        if (empty($post->post_title))
            $title = $previous ? __('Previous Post') : __('Next Post');
        
        $title = apply_filters('the_title', $title, $post->ID);
        $date  = mysql2date(get_option('date_format'), $post->post_date);
        $rel   = $previous ? 'prev' : 'next';
        
        $string = '<a href="' . get_permalink($post) . '" rel="' . $rel . '">';
        $inlink = str_replace('%title', $title, $link);
        $inlink = str_replace('%date', $date, $inlink);
        $inlink = $string . $inlink . '</a>';
        
        
        $output = str_replace('%link', $inlink, $format);
    }
    
    $adjacent = $previous ? 'previous' : 'next';
    
    apply_filters("{$adjacent}_post_link", $output, $format, $link, $post);
    
    return $output;
}

function apply_panorama_view($content = '')
{
    
    //	file_put_contents('original.log', $content, FILE_APPEND);
    $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
    ;
    
    $doc = new DOMDocument('1.0', 'iso-8859-1');
    
    @$doc->loadHTML($content);
    $doc->encoding = 'utf-8';
    
    $tags = $doc->getElementsByTagName('img');
    
    foreach ($tags as $tag) {
        $image  = $tag->getAttribute('src');
        $filter = "/\.(jpg|jpeg|gif|png)/i"; // only allow specific set format of picture to avoid malicious file upload
        
        if (!preg_match($filter, $image)) {
            //	check if extension are allowed, continue to next tag if not allowed
            continue;
        }
        
        $dim = get_image_dim($tag);
        
        if ($dim['width'] < 100 || $dim['height'] < 400) {
            //	skip to the next tag if current image width is less than 100 px
            continue;
        }
        
        //	execute add new div if image ratio is more than 2
        if ($dim['ratio'] > 2 && $dim['orientation'] == 'landscape') {
            //	get the image source
            $image_source = $tag->getAttribute('src');
            $image_alt    = $tag->getAttribute('alt');
            $image_title  = $tag->getAttribute('title');
            
            //	create new div element & assign attribute
            
            //$new_dom = new DOMDocument('1.0', 'iso-8859-1');
            
            $new_element = $doc->createElement('div');
            $new_element->setAttribute('class', 'panorama-view');
            $new_element->setAttribute('style', 'max-width:100%;max-height:600px;height:auto;overflow:hidden;');
            
            $new_image = $doc->createElement('img');
            $new_image->setAttribute('style', 'width:auto;max-width:1000%;height:100%;position:absolute;left:0;right:0;top:0;bottom:0;');
            $new_image->setAttribute('src', $image_source);
            $new_image->setAttribute('alt', $image_alt);
            $new_image->setAttribute('title', $image_title);
            
            $new_element->appendChild($new_image);
            
            //file_put_contents('log.log',simplexml_import_dom($new_element)->asXML());
            
            $tag->parentNode->replaceChild($new_element, $tag);
        } else {
            //	do nothing	
        }
    }
    
    //$doc->formatOutput = false;
    
    echo $output = /*html_entity_decode*/ ($doc->saveHTML());
    
    //file_put_contents('panorama.log', $output, FILE_APPEND);
    
}

function get_image_dim($tag)
{
    if ($tag->getAttribute('width')) {
        //	if width attribute found
        
        $result['width']  = $tag->getAttribute('width');
        $result['height'] = $tag->getAttribute('height');
    } else {
        //	if width attribute not found check on style attribute
        
        $style = $tag->getAttribute('style');
        
        $attrs = explode(";", $style);
        
        foreach ($attrs as $attr) {
            if (strlen(trim($attr)) > 0) {
                $kv                   = explode(":", trim($attr));
                $parsed[trim($kv[0])] = trim($kv[1]);
            }
        }
        
        $result['width']  = (int) $parsed['width'];
        $result['height'] = (int) $parsed['height'];
    }
    
    if ($result['width'] && $result['height']) {
        if ($result['width'] > $result['height']) {
            $result['orientation'] = 'landscape';
            $result['ratio']       = $result['width'] / $result['height'];
        } else {
            $result['orientation'] = 'portrait';
            $result['ratio']       = $result['height'] / $result['width'];
        }
    } else {
        $result['orientation'] = null;
        $result['ratio']       = null;
    }
    
    return $result;
}

function start_timer()
{
    if (current_user_can('manage_options')) {
        return microtime(true);
    } else {
        return null;
    }
}

function get_duration($start)
{
    if (current_user_can('manage_options')) {
        return ((microtime(true) - $start) * 1000) . 'ms';
    } else {
        return null;
    }
}

/////////	ecommerce specific functions
function create_currency($value)
{
    return $value = 'Rp ' . number_format(($value), 0, ',', '.') . ',-';
}

function ecc_category_to_array($array)
{
    $result = array();
    
    foreach ($array as $key => $content) {
        if ($content->parent == 0) {
            $result[$content->term_id]['name'] = $content->name;
            $result[$content->term_id]['slug'] = $content->slug;
        } else {
            $result[$content->parent][$content->term_id]['name'] = $content->name;
            $result[$content->parent][$content->term_id]['slug'] = $content->slug;
        }
    }
    
    return $result;
}

add_action('admin_menu', 'ecc_theme_menu');

function ecc_theme_menu()
{
    /**	register top level menu here	**/
    add_menu_page('Commerce', 'Commerce', "manage_options", 'ecc_admin_option_menu', 'ecc_admin_option_menu');
    
    
    /**	register the dashboard page	by override the top level slug	**/
    /*$emgl_dashboard_page = add_submenu_page('emgl_top_menu', 'Guest List Dashboard', "Dashboard","manage_options", 'emgl_top_menu', 'emgl_top_menu');
    
    add_action('load-'.$emgl_dashboard_page, 'emgl_enqueue_admin');*/
    
    /**	register the option page	**/
    $emgl_option_page = add_submenu_page('ecc_admin_option_menu', 'Commerce Options', "Options", "manage_options", 'emgl_option_menu', 'emgl_option_menu');
    
    add_action('load-' . $emgl_dashboard_page, 'emgl_register_script');
    add_action('load-' . $emgl_option_page, 'emgl_register_script');
    
}

function ecc_admin_option_menu()
{
    /**	show the option page	**/
    if (!current_user_can('administrator')) {
        
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    
    //	load the template of administrator menu form
    get_template_part('template/admin/option');
}

function ecc_theme_install()
{
    require_once(__DIR__ . '/config/config.php');
    
    foreach ($default_value as $key => $content) {
        update_option($key, $content);
    }
}

function ecc_theme_uninstall()
{
    
}

add_action('init', 'create_product_taxonomy', 0);

// create two taxonomies, genres and writers for the post type "book"
function create_product_taxonomy()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => _x('Brands', 'taxonomy general name'),
        'singular_name' => _x('Brand', 'taxonomy singular name'),
        'search_items' => __('Search Brands'),
        'all_items' => __('All Brands'),
        'parent_item' => __('Parent Brand'),
        'parent_item_colon' => __('Parent Brand:'),
        'edit_item' => __('Edit Brand'),
        'update_item' => __('Update Brand'),
        'add_new_item' => __('Add New Brand'),
        'new_item_name' => __('New Brand Name'),
        'menu_name' => __('Brand')
    );
    
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'brand'
        )
    );
    
    register_taxonomy('brand', array(
        'product'
    ), $args);
}

function get_all_brand()
{
    $taxonomies = array(
        'brand'
    );
    
    $args = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false,
        'exclude' => array(),
        'exclude_tree' => array(),
        'include' => array(),
        'number' => '',
        'fields' => 'all',
        'slug' => '',
        'name' => '',
        'parent' => '',
        'hierarchical' => true,
        'child_of' => 0,
        'get' => '',
        'name__like' => '',
        'description__like' => '',
        'pad_counts' => true,
        'offset' => '',
        'search' => '',
        'cache_domain' => 'core'
    );
    
    $brands = get_terms($taxonomies, $args);
    
    return $brands;
    
}

function show_all_brand()
{
    global $ecc_brand;
    
    $ecc_brand = get_all_brand();
    
    get_template_part('template/widget/ecc', 'brand-list');
    
}

class ecc_brand_widget extends WP_Widget
{
    
    function __construct()
    {
        $params = array(
            'description' => 'Commerce Brand', //plugin description
            'name' => 'Commerce Brand' //title of plugin
        );
        parent::__construct('ecc_brand_widget', '', $params);
    }
    
    
    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    
    public function widget($args, $instance)
    {
        
        extract($args, EXTR_SKIP);
        $ipaddress = isset($instance['ip_display']) ? $instance['ip_display'] : false; // display ip address
        $stime     = isset($instance['server_time']) ? $instance['server_time'] : false; // display server time
        $fontcolor = $instance['font_color'];
        
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        if (!empty($title))
            echo $before_title . $title . $after_title;
        
        
        /**
         *
         *	extract the visitor data
         *
         **/
        $start_time = microtime(true);
        
        
        echo $before_widget;
        
        /**	get visitor data from table	**/
        show_all_brand();
        
        echo $after_widget;
    }
}

add_action('widgets_init', 'register_ecc_widget');

/**	register all ecc widget	**/

function register_ecc_widget()
{
    register_widget('ecc_brand_widget', 'ecc_brand_widget_style');
}

//	add new post type called banner

add_action('init', 'ecc_create_post_type');
function ecc_create_post_type()
{
    
    $support = array(
        0 => 'title',
        1 => 'editor',
        3 => 'thumbnail',
        4 => 'excerpt'
    );
    register_post_type('banner', array(
        'labels' => array(
            'name' => __('Banner'),
            'singular_name' => __('Banner')
        ),
        'public' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'supports' => $support
    ));
}


function ecc_load_inquiry_form($atts)
{
    
    ob_start();
    get_template_part('template/ecc', 'inquiry-form');
    
    $result = ob_get_contents();
    
    ob_end_clean();
    
    return $result;
}
add_shortcode('ecc-inquiry-form', 'ecc_load_inquiry_form');

/**	add shortcode for ecc-kontainer-connect	**/
function ecc_kontainer_connect($atts)
{
    
    ob_start();
    get_template_part('template/page/ecc', 'kontainer-connect');
    
    $result = ob_get_contents();
    
    ob_end_clean();
    
    return $result;
}
add_shortcode('ecc-kontainer-connect', 'ecc_kontainer_connect');

/**	add shortcode for ecc-kontainer-feature	**/

function ecc_kontainer_feature($atts, $content = "")
{
    
    ob_start();
    get_template_part('template/page/ecc', 'kontainer-feature');
    
    $result = ob_get_contents();
    
    ob_end_clean();
    
    $result = preg_replace('/\%content\%/', $content, $result);
    
    return $result;
}
add_shortcode('ecc-kontainer-feature', 'ecc_kontainer_feature');

/**	add shortcode for ecc-kontainer-about-us	**/
function ecc_kontainer_about_us($atts, $content = "")
{
    
    ob_start();
    get_template_part('template/page/ecc', 'kontainer-about-us');
    
    $result = ob_get_contents();
    
    ob_end_clean();
    
    $result = preg_replace('/\%content\%/', $content, $result);
    
    return $result;
}
add_shortcode('ecc-kontainer-about-us', 'ecc_kontainer_about_us');

/**	add shortcode for ecc-social-feed	**/
function ecc_social_feed($atts, $content = "")
{
    require_once(__DIR__ . '/library/php/social-media-feed/ecc-feed.class.php');
    
    ob_start();
    Ecc_Feed::show_feed($atts['service'], get_option('ecc_' . $atts['service'] . '_name'), get_option('ecc_' . $atts['service'] . '_feed'));
    
    $result = ob_get_contents();
    
    ob_end_clean();
    
    return $result;
}
add_shortcode('ecc-social-feed', 'ecc_social_feed');

function ecc_create_form($args)
{
    foreach ($args as $key => $content) {
        
        if ($content['type'] == 'button') {
?>	

<div class="ecc-row-wrapper">
<div class='ecc-row-input'>
  <input type="button" name="<?php
            _e($content['class']);
?>" value=" <?php
            _e($content['title']);
?>">
</div>
<?php
        } elseif ($content['type'] == 'submit') {
?>
<div class="ecc-row-wrapper">
<div class='ecc-row-input'>
  <input type="submit" name="<?php
            _e($content['class']);
?>" value=" <?php
            _e($content['title']);
?>">
</div>
<?php
            
        }
        
        else {
?>
<div class="ecc-row-wrapper">
  <div class='ecc-row-name'>
    <label for="<?php
            _e($content['class']);
?>">
      <?php
            _e($content['title']);
?>
    </label>
  </div>
  <?php
            
        }
        
        $content['default'] = (@$content['default']) ? $content['default'] : '';
        
        if ($content['type'] == 'text') {
?>
  <div class='ecc-row-input'>
    <input type="text" name="<?php
            _e($content['class']);
?>" value="<?php
            _e($content['default']);
?>" placeholder="<?php
            _e($content['description']);
?>" />
    <div class="ecc-row-input-desc"></div>
  </div>
  <?php
        } elseif ($content['type'] == 'textarea') {
?>
  <div class='ecc-row-input'>
    <textarea name="<?php
            _e($content['class']);
?>" placeholder="<?php
            _e($content['description']);
?>"><?php
            _e($content['default']);
?></textarea>
    <div class="ecc-row-input-desc"></div>
  </div>
  <?php
            
        } elseif ($content['type'] == 'button' || $content['type'] == 'submit') {
            continue;
        }
        
?>
</div>
<?php
        
    }
}

function ecc_load_header_meta()
{
    echo '<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">';
    echo '<link href="' . site_url() . '/xmlrpc.php?rsd" rel="EditURI" type="application/rsd+xml" title="RSD" />';
    
    //	create title meta
    echo '<title>';
    if (defined('WPSEO_URL')) {
        // If Using WordPress SEO Yoast - let it override
        wp_title('|');
    } else {
        wp_title('|', TRUE, 'right'); //	the title tag defined here
    }
    echo '</title>';
    
    
    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    
    do_action('ecc_load_meta_other');
}

function ecc_load_header_script()
{
    wp_enqueue_style('ecc-style', get_template_directory_uri() . '/style.css', array(), '1.0.0');
    
    do_action('ecc_load_css_other');
    
    //	load jquery script
    wp_enqueue_script('jquery');
    //	queue the javascript here
    wp_enqueue_script('ecc-function', get_template_directory_uri() . '/library/js/functions.js', array(
        'jquery'
    ), '1.0', false); //	load the 3mark library script
    if (is_singular())
        wp_enqueue_script('comment-reply'); //	if single page detected load the comment function
    do_action('ecc_load_js_other');
    
    wp_head();
    
}

add_action('ecc_load_js_other', 'ecc_load_init_grid');

function ecc_load_init_grid()
{
    wp_enqueue_script('ecc-init-grid', get_template_directory_uri() . '/library/js/ecc-init-grid.js', array(
        'jquery'
    ), '1.0', false); //	load the 3mark library script}

}
add_action('ecc_load_js_other', 'ecc_load_init_header');

function ecc_load_init_header()
{
    wp_enqueue_script('ecc-init-header', get_template_directory_uri() . '/library/js/ecc-init-header.js', array(
        'jquery'
    ), '1.0', false); //	load the 3mark library script}
}

/**	add content filtering to header single product page	**/
add_action('ecc_single_page_before', 'ecc_filter_content_start', 1);
add_action('ecc_single_page_after', 'ecc_filter_content_end', 100);

/**	add content filtering to page header	**/
add_action('ecc_page_before', 'ecc_filter_content_start', 1);
add_action('ecc_page_after', 'ecc_filter_content_end', 100);

/**	add content filtering to index header	**/
add_action('ecc_index_before', 'ecc_filter_content_start', 1);
add_action('ecc_index_after', 'ecc_filter_content_end', 100);

/**	add content filtering to search header	**/
add_action('ecc_search_before', 'ecc_filter_content_start', 1);
add_action('ecc_search_after', 'ecc_filter_content_end', 100);

/**	add content filtering to single header	**/
add_action('ecc_single_before', 'ecc_filter_content_start', 1);
add_action('ecc_single_after', 'ecc_filter_content_end', 100);



function ecc_filter_content_start()
{
	ob_start();	
}

function ecc_filter_content_end()
{
	$result = ob_get_contents();
	
	ob_end_clean();	
	
	$result = apply_filters('ecc_filter_content', $result);
	
	echo $result;
}


/**	attach image loader to content hook	**/
if(get_option('ecc_image_loader_enable') == true)
{
add_filter( 'ecc_filter_content', 'ecc_filter_image', 100 );
function ecc_filter_image($content)
{
	require_once(__DIR__.'/library/php/image-loader/ecc-image-loader.class.php');
	return Ecc_Image_Loader::filter_image($content);
}
}
?>