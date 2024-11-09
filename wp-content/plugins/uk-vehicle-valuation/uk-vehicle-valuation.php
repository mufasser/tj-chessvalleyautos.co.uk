<?php
/*
Plugin Name: UK Vehicle Valuation
Plugin URI: http://www.webmobi.tech/
Description: Plugin use to search uk vehicle by using api https://ukvehicledata.co.uk/
Version: 1.0.0
Author: Mufassir Islam
Author URI: https://www.webmobi.tech/contact/
License: GPL2
*/


define('UK_VEHICLE_PLUGIN_DIR',plugin_dir_path(__FILE__));
define('UK_VEHICLE_PLUGIN_URI',plugin_dir_url(__FILE__));

require_once  UK_VEHICLE_PLUGIN_DIR.'/VehicleInformation.php';
require_once UK_VEHICLE_PLUGIN_DIR.'/vehicle-api.php';

function ukEnqueueScript(){
    
    // script
    
    wp_register_script( 'jquery3.2.1', 'https://code.jquery.com/jquery-3.2.1.min.js' );
    wp_add_inline_script( 'jquery3.2.1', 'var jQuery3_2_1 = $.noConflict(true);' );
    // wp_enqueue_script( 'plugin-javascript', plugins_url( 'js.js', __FILE__ ), array( 'jquery3.2.1' ) );
    
    // wp_enqueue_script('jquery','https://code.jquery.com/jquery-3.7.1.min.js', [], '3.7.1');
    wp_enqueue_script('ukv-bootstrap-script','https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js', [], '5.2.3');
    wp_enqueue_script( 'mi-custom-js', plugins_url(  '/js/custom.js' , __FILE__ ) , ['jquery3.2.1'], '1.0'  );
    
    // style
    wp_enqueue_style('ukv-bootstrap-style','https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css',[],'5.2.3');
    
    wp_enqueue_style( 'mi-custom-css', plugins_url( '/css/style.css', __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'ukEnqueueScript' );


function ukVehicleSearchForm(){
    
    $action = home_url("valuations");
    $form = '
    <section>
    <div class="container vehicle-search-form-container">
    <form action="'.$action.'" method="GET" id="form-search-vehicle-form" class="form vehicle-search-form">
        <input type="hidden" name="step" value="2">
        <input type="hidden" name="gsh" value="0">
        <input type="hidden" name="lh" value="1">
        <input type="hidden" name="voilocationHash" value="2">
        <input type="hidden" name="voimake" value="3">
        <input type="hidden" name="voimodel" value="4">
        <input type="hidden" name="voidateOfReg" value="5">
        <input type="hidden" name="voiprice" value="6">
        <input type="hidden" name="voiimage" value="7">
        <input type="hidden" name="voicapId" value="8">
        <input type="hidden" name="voitype" value="9">
        <input type="hidden" name="voiurl" value="10">
        <input type="hidden" name="voivrm" value="11">
        <input type="hidden" name="voimileage" value="12">
        
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <div class="controls">
                        <input type="text" class="form-control" required name="vehicle_plate_number" placeholder="Your Registration Number" id="vehicle-registration">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="controls">
                        <input type="text" class="form-control required name="current_odometer_reading" placeholder="Your Mileage" id="current-mileage">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <button type="submit" rel="nofollow" title="Value My Car"class="btn btn-block btn-primary button"><span>Value My Car</span></a>
            </div>
        </div> <!-- row -->
            </form>
        </div> <!-- container -->
    </section>
    ';
    return $form;
}
add_shortcode('uk_vehicle_search_form','ukVehicleSearchForm');


// page routes defining moment
add_filter( 'generate_rewrite_rules', function ( $wp_rewrite ){
    $wp_rewrite->rules = array_merge(
        [
            'valuate/?$' => 'index.php?vehicleresult=1',
            'valuations/?$' => 'index.php?vvv=1'
        ],
        $wp_rewrite->rules
    );
    
} );


add_filter( 'query_vars', function( $query_vars ){
    $query_vars[] = 'vehicleresult';
    $query_vars[] = 'vvv';
    return $query_vars;
} );


add_filter('template_include', 'miCustomTemplate', 1, 1);

function miCustomTemplate($template){
    
    $vehicleresult = intval( get_query_var( 'vehicleresult' ) );
    if ( $vehicleresult > 0 ) {
        $template = plugin_dir_path( __FILE__ ) . 'templates/vehicle-result.php';
        // return $template;
    }

    $valuations = intval( get_query_var( 'vvv' ) );
    if ( $valuations > 0 ) {
        $template = plugin_dir_path( __FILE__ ) . 'templates/vehicle-result.php';
    }
    // echo $template;
        return $template;
    
    }



// add_action( 'template_redirect', function(){
    
//     $vehicleresult = intval( get_query_var( 'vehicleresult' ) );
//     echo "me called";
//     var_dump($vehicleresult);
//     if ( $vehicleresult > 0 ) {
//         include plugin_dir_path( __FILE__ ) . 'templates/vehicle-result.php';
//     }

//     $valuations = intval( get_query_var( 'vvv' ) );
//     echo "me called 2 ";
//     var_dump($valuations);
//     if ( $valuations > 0 ) {
//         include plugin_dir_path( __FILE__ ) . 'templates/vehicle-result.php';
//     }
    
// } );


