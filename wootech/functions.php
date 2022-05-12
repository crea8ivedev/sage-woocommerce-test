<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

try {
    \Roots\bootloader();
} catch (Throwable $e) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'sage'),
        '',
        [
            'link_url' => 'https://docs.roots.io/acorn/2.x/installation/',
            'link_text' => __('Acorn Docs: Installation', 'sage'),
        ]
    );
}

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters', 'cpt'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });

/*
|--------------------------------------------------------------------------
| Enable Sage Theme Support
|--------------------------------------------------------------------------
|
| Once our theme files are registered and available for use, we are almost
| ready to boot our application. But first, we need to signal to Acorn
| that we will need to initialize the necessary service providers built in
| for Sage when booting.
|
*/

add_theme_support('sage');

/*
|--------------------------------------------------------------------------
| Enable ACF Theme Support
|--------------------------------------------------------------------------
*/

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}

/*
|--------------------------------------------------------------------------
| Enable SVG Theme Support
|--------------------------------------------------------------------------
*/
function add_svg_to_upload_mimes( $upload_mimes ) { 
	$upload_mimes['svg'] = 'image/svg+xml'; 
	$upload_mimes['svgz'] = 'image/svg+xml'; 
	return $upload_mimes; 
} 
add_filter( 'upload_mimes', 'add_svg_to_upload_mimes', 10, 1 );

/*
|--------------------------------------------------------------------------
| Woocommerce Remove Single Product Support
|--------------------------------------------------------------------------
*/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/*
|--------------------------------------------------------------------------
| Woocommerce Add Single Product Support
|--------------------------------------------------------------------------
*/
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 40);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 40);


/*
|--------------------------------------------------------------------------
| Woocommerce Remove Comapny Field
|--------------------------------------------------------------------------
*/
add_filter( 'woocommerce_checkout_fields' , 'remove_company_name' );
function remove_company_name( $fields ) {
     unset($fields['billing']['billing_company']);
     return $fields;
}

/*
|--------------------------------------------------------------------------
| Woocommerce Move Country Field Last To Zipcode Field 
|--------------------------------------------------------------------------
*/
add_filter( 'woocommerce_default_address_fields', 'bbloomer_reorder_checkout_fields' );
 
function bbloomer_reorder_checkout_fields( $fields ) {
  $fields['country']['priority'] = 91;
  return $fields;
}

/** Load more Accommodation start **/
add_action('wp_ajax_nopriv_unspalsh_prod_img_api', 'unspalsh_prod_img_api');
add_action('wp_ajax_unspalsh_prod_img_api', 'unspalsh_prod_img_api');

function unspalsh_prod_img_api(){

    $keyword = (isset($_POST['keyword'])) ? $_POST['keyword'] : '';

    header("Content-Type: text/html");

    if(!empty($keyword)){
        $url = "https://api.unsplash.com/search/photos?page=1&per_page=3&query=".$keyword;
    
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        $headers = array(
            "Authorization: Client-ID 7oLwbCKQ9j3J85pVJKOrqQonqghwNaQhRtCzwya-oW0",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
        $resp = curl_exec($curl);

        $resp = json_decode($resp);

        $respimg_html = '';
        
        foreach($resp as $img){
            if(is_array($img) ){
                foreach($img as $img_url){
                    $respimg_html .= '<img src="'.$img_url->urls->full.'" alt="product image">';
                }
            }
        }

        curl_close($curl);
        // var_dump($resp);
        
        $respo_array = json_encode(array('result' => $respimg_html));
    } else {
        $respo_array = json_encode(array('result' => ''));
    }

    die($respo_array);
}