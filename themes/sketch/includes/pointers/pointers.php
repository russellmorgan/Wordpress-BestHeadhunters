<?php

add_action( 'admin_enqueue_scripts', 'okay_pointer_load', 1000 );
 
function okay_pointer_load( $hook_suffix ) {
 
    // Don't run on WP < 3.3
    if ( get_bloginfo( 'version' ) < '3.3' )
        return;
 
    $screen = get_current_screen();
    $screen_id = $screen->id;
 
    // Get pointers for this screen
    $pointers = apply_filters( 'okay_admin_pointers-' . $screen_id, array() );
 
    if ( ! $pointers || ! is_array( $pointers ) )
        return;
 
    // Get dismissed pointers
    $dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
    $valid_pointers =array();
 
    // Check pointers and remove dismissed ones
    foreach ( $pointers as $pointer_id => $pointer ) {
 
        // Sanity check
        if ( in_array( $pointer_id, $dismissed ) || empty( $pointer )  || empty( $pointer_id ) || empty( $pointer['target'] ) || empty( $pointer['options'] ) )
            continue;
 
        $pointer['pointer_id'] = $pointer_id;
 
        // Add the pointer to $valid_pointers array
        $valid_pointers['pointers'][] =  $pointer;
    }
 
    // No valid pointers? Stop here.
    if ( empty( $valid_pointers ) )
        return;
 
    // Add pointers style to queue
    wp_enqueue_style( 'wp-pointer' );
 
    // Add pointers script to queue and add custom script
    wp_enqueue_script( 'okay-pointer', get_template_directory_uri() . '/includes/pointers/pointers.js', array( 'wp-pointer' ) );
 
    // Add pointer options to script
    wp_localize_script( 'okay-pointer', 'okayPointer', $valid_pointers );
    
    // Add custom styles for pointers
    wp_register_style( 'wp_pointers_admin_css', get_template_directory_uri() . '/includes/pointers/pointers.css', false, '1.0.0' );
    wp_enqueue_style( 'wp_pointers_admin_css' );
	
	add_action( 'admin_enqueue_scripts', 'load_wp_pointer_styles' );
}



//---------------------  // Pointers // ---------------------//



//Theme setup info shown after activation

add_filter( 'okay_admin_pointers-themes', 'okay_register_pointer_customize' );
function okay_register_pointer_customize( $p ) {
    
    //Theme name title
    $theme_name_title = wp_get_theme();
    
    //Theme name for docs url
    $themename = wp_get_theme('sketch');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
    $doc_url = 'http://themes.okaythemes.com/docs/'.$themename.'';
    
    //Customizer url
    $customize_url = admin_url('customize.php');
    
    //Okay Toolkit install url
    $toolkit_url = admin_url('plugin-install.php?tab=plugin-information&plugin=okay-toolkit&TB_iframe=true&width=640&height=589');
    
    $p['ok-customize'] = array(
        'target' => '#menu-appearance',
        'options' => array(
            'content' => sprintf( '<h3> %s </h3> <p> %s </p>',
                __( 'Setup & Customize ' . $theme_name_title . '' ,'okay'),
                __( '<ul>
                	 <li>To get started, check out the <strong><a target="blank" href=" ' . $doc_url . ' ">Help File and Install Video</a></strong> for your theme.</li> 		 <li><strong><a class="thickbox onclick" href=" ' . $toolkit_url . ' ">Install and activate</a></strong> the Okay Toolkit, which adds awesome features to your theme.</li>
                	 <li>Setup and customize your theme by going to <strong><a href=" ' . $customize_url . ' ">Appearance &rarr; Customize</a></strong></li>
                	 </ul>','okay')
            ),
            'position' => array( 'edge' => 'left', 'align' => 'right' )
        )
    );
    return $p;
}



//Widget setup info shown on widgets page

add_filter( 'okay_admin_pointers-widgets', 'okay_register_pointer_widgets' );
function okay_register_pointer_widgets( $p ) {
    
    //Only show if user hasn't activated any widgets yet
    if ( !function_exists('okaysocial_init') ) {
    
	    //Okay Toolkit install url
	    $toolkit_url = admin_url('plugin-install.php?tab=plugin-information&plugin=okay-toolkit&TB_iframe=true&width=640&height=589');
	    
	    //Okay Toolkit settings url
	    $toolkit_settings_url = admin_url('options-general.php?page=okay-toolkit/okay-toolkit.php');
	    
	    //Add ThickBox for modal plugin install
	    add_thickbox();
	    
	    $p['ok-widgets'] = array(
	        'target' => '#widgets-right',
	        'options' => array(
	            'content' => sprintf( '<h3> %s </h3> <p> %s </p>',
	                __( 'Get More Widgets!' . $theme_name_title . '' ,'okay'),
	                __( '<ul>
	                	 <li>Add Twitter, Flickr, Dribbble and Social Media Icon widgets by <strong><a class="thickbox onclick" href=" ' . $toolkit_url . ' ">installing the Okay Toolkit plugin</a></strong>.</li>
	                	 <li>Once installed, go to <strong>Settings &rarr; Okay Toolkit</strong> and activate the widgets you would like to use.</li>
	                	 </ul>','okay')
	            ),
	            'position' => array( 'edge' => 'right', 'align' => 'right' )
	        )
	    );
	    return $p;
    }
}