<?php

// ------------- Theme Customizer  ------------- //

add_action( 'customize_register', 'okay_theme_customizer_register' );

function okay_theme_customizer_register($wp_customize) {
	
	//Add Textarea 
	class Okay_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}
	
	//Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
    
    
	//-----------------  // Style Options //-----------------//


	$wp_customize->add_section( 'okay_theme_customizer_basic', array(
		'title' => __( 'Sketch Styling', 'okay_theme_customizer' ),
		'priority' => 100
	) );
	
	//Logo Image
	$wp_customize->add_setting( 'okay_theme_customizer_logo', array(
		'type' => 'option'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'theme_logo', array(
		'label' => 'Logo Upload',
		'section' => 'okay_theme_customizer_basic',
		'settings' => 'okay_theme_customizer_logo'
	) ) );
	
	//Color Scheme
	$wp_customize->add_setting('okay_theme_customizer_color_scheme', array(
        'default'        => 'light',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    
    $wp_customize->add_control( 'color_scheme_select_box', array(
        'settings' => 'okay_theme_customizer_color_scheme',
        'label'   => 'Color Scheme',
        'section' => 'okay_theme_customizer_basic',
        'type'    => 'select',
        'choices'    => array(
            'light' => 'Light',
            'dark' => 'Dark',
        ),
    ));
	
	//Accent Color
	$wp_customize->add_setting( 'okay_theme_customizer_accent', array(
		'default' => '#22AAE3',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'okay_theme_customizer_accent', array(
		'label'   => __( 'Accent Color', 'okay' ),
		'section' => 'okay_theme_customizer_basic',
		'settings'   => 'okay_theme_customizer_accent'
	) ) );
	
	//Link Color
	$wp_customize->add_setting( 'okay_theme_customizer_link', array(
		'default' => '#22AAE3',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'okay_theme_customizer_link', array(
		'label'   => __( 'Link Color', 'okay' ),
		'section' => 'okay_theme_customizer_basic',
		'settings'   => 'okay_theme_customizer_link'
	) ) );
	
	//Custom CSS
	$wp_customize->add_setting( 'okay_theme_customizer_css', array(
        'default' => '',
    ) );
    
    $wp_customize->add_control( new Okay_Customize_Textarea_Control( $wp_customize, 'okay_theme_customizer_css', array(
	    'label'   => 'Custom CSS',
	    'section' => 'okay_theme_customizer_basic',
	    'settings'   => 'okay_theme_customizer_css',
	) ) );
	

	//-----------------  // Header Section //-----------------//


	$wp_customize->add_section( 'okay_theme_customizer_header', array(
		'title' => __( 'Sketch Header Section', 'okay_theme_customizer' ),
		'priority' => 110
	) );
	
	//Header Image
	$wp_customize->add_setting( 'okay_theme_customizer_header_image', array(
		'type' => 'option'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'okay_theme_customizer_header_image', array(
		'label' => 'Header Image',
		'section' => 'okay_theme_customizer_header',
		'settings' => 'okay_theme_customizer_header_image'
	) ) );
	
	//Header Title
	$wp_customize->add_setting( 'okay_theme_customizer_main_title', array(
		'default' => '',
		'transport' => 'postMessage',
		'type' => 'option'
	) );

	$wp_customize->add_control( 'okay_theme_customizer_main_title', array(
		'label' => 'Header Main Title',
		'section' => 'okay_theme_customizer_header',
		'settings' => 'okay_theme_customizer_main_title',
		'type' => 'text'
	) );
	
	//Header Subtitle
	$wp_customize->add_setting( 'okay_theme_customizer_sub_title', array(
		'default' => '',
		'transport' => 'postMessage',
		'type' => 'option'
		
	) );

	$wp_customize->add_control( 'okay_theme_customizer_sub_title', array(
		'label' => 'Header Subtitle',
		'section' => 'okay_theme_customizer_header',
		'settings' => 'okay_theme_customizer_sub_title',
		'type' => 'text'
	) );
	
	
	//-----------------  // About Section //-----------------//
	
	
	$wp_customize->add_section( 'okay_theme_customizer_about', array(
		'title' => __( 'Sketch About Section', 'okay_theme_customizer' ),
		'priority' => 111
	) );
	
	//Enable About Section
	$wp_customize->add_setting('okay_theme_customizer_enable_about', array(
        'default'        => 'enabled',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    
    $wp_customize->add_control( 'enable_about_select_box', array(
        'settings' => 'okay_theme_customizer_enable_about',
        'label'   => 'Enable About Section',
        'section' => 'okay_theme_customizer_about',
        'type'    => 'select',
        'choices'    => array(
            'enabled' => 'Enabled',
            'disabled' => 'Disabled',
        ),
    ));
    
    //About Page
	$wp_customize->add_setting('okay_theme_customizer_about_page', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    
    $wp_customize->add_control( 'about_page_select_box', array(
        'settings' => 'okay_theme_customizer_about_page',
        'label'   => 'About Page',
        'section' => 'okay_theme_customizer_about',
        'type'    => 'select',
        'choices' => $options_pages,
    ));
    
    
    //-----------------  // Portfolio Section //-----------------//
	
	
	$wp_customize->add_section( 'okay_theme_customizer_portfolio', array(
		'title' => __( 'Sketch Portfolio Section', 'okay_theme_customizer' ),
		'priority' => 112
	) );
	
	//Enable Portfolio Section
	$wp_customize->add_setting('okay_theme_customizer_enable_portfolio', array(
        'default'        => 'enabled',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    
    $wp_customize->add_control( 'enable_portfolio_select_box', array(
        'settings' => 'okay_theme_customizer_enable_portfolio',
        'label'   => 'Enable Portfolio Section',
        'section' => 'okay_theme_customizer_portfolio',
        'type'    => 'select',
        'choices'    => array(
            'enabled' => 'Enabled',
            'disabled' => 'Disabled',
        ),
        'priority' => 1
    ));
    
    //Portfolio Category
	$wp_customize->add_setting('okay_theme_customizer_portfolio_cat', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    
    $wp_customize->add_control( 'portfolio_cat_select_box', array(
        'settings' => 'okay_theme_customizer_portfolio_cat',
        'label'   => 'Portfolio Category',
        'section' => 'okay_theme_customizer_portfolio',
        'type'    => 'select',
        'choices' => $options_categories,
        'priority' => 2
    ));
    
    //Portfolio Title
	$wp_customize->add_setting( 'okay_theme_customizer_portfolio_title', array(
		'default' => '',
		'transport' => 'postMessage',
		'type' => 'option'
	) );

	$wp_customize->add_control( 'okay_theme_customizer_portfolio_title', array(
		'label' => 'Portfolio Section Title',
		'section' => 'okay_theme_customizer_portfolio',
		'settings' => 'okay_theme_customizer_portfolio_title',
		'type' => 'text',
		'priority' => 3
	) );
	
	//Enable Portfolio Sorting
	$wp_customize->add_setting('okay_theme_customizer_enable_portfolio_sort', array(
        'default'        => 'enabled',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    
    $wp_customize->add_control( 'enable_portfolio_sort_select_box', array(
        'settings' => 'okay_theme_customizer_enable_portfolio_sort',
        'label'   => 'Enable Portfolio Sorting',
        'section' => 'okay_theme_customizer_portfolio',
        'type'    => 'select',
        'choices'    => array(
            'enabled' => 'Enabled',
            'disabled' => 'Disabled',
        ),
        'priority' => 5
    ));
	
	
	//-----------------  // Blog Section //-----------------//
	
	
	$wp_customize->add_section( 'okay_theme_customizer_blog', array(
		'title' => __( 'Sketch Blog Section', 'okay_theme_customizer' ),
		'priority' => 113
	) );
	
	//Enable Blog Section
	$wp_customize->add_setting('okay_theme_customizer_enable_blog', array(
        'default'        => 'enabled',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    
    $wp_customize->add_control( 'enable_blog_select_box', array(
        'settings' => 'okay_theme_customizer_enable_blog',
        'label'   => 'Enable Blog Section',
        'section' => 'okay_theme_customizer_blog',
        'type'    => 'select',
        'choices'    => array(
            'enabled' => 'Enabled',
            'disabled' => 'Disabled',
        ),
        'priority' => 1
    ));
    
    //Blog Category
	$wp_customize->add_setting('okay_theme_customizer_blog_cat', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    
    $wp_customize->add_control( 'blog_cat_select_box', array(
        'settings' => 'okay_theme_customizer_blog_cat',
        'label'   => 'Blog Category',
        'section' => 'okay_theme_customizer_blog',
        'type'    => 'select',
        'choices' => $options_categories,
        'priority' => 2
    ));
    
    
    //-----------------  // Social Widget Section //-----------------//
	
	
	$wp_customize->add_section( 'okay_theme_customizer_social', array(
		'title' => __( 'Sketch Social Widget Section', 'okay_theme_customizer' ),
		'priority' => 114
	) );
	
	//Enable Contact Section
	$wp_customize->add_setting('okay_theme_customizer_enable_social', array(
        'default'        => 'enabled',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    
    $wp_customize->add_control( 'enable_social_select_box', array(
        'settings' => 'okay_theme_customizer_enable_social',
        'label'   => 'Enable Social Section',
        'section' => 'okay_theme_customizer_social',
        'type'    => 'select',
        'choices'    => array(
            'enabled' => 'Enabled',
            'disabled' => 'Disabled',
        ),
        'priority' => 1
    ));
    
    
    //-----------------  // Contact Section //-----------------//
	
	
	$wp_customize->add_section( 'okay_theme_customizer_contact', array(
		'title' => __( 'Sketch Contact Section', 'okay_theme_customizer' ),
		'priority' => 115
	) );
	
	//Enable Contact Section
	$wp_customize->add_setting('okay_theme_customizer_enable_contact', array(
        'default'        => 'enabled',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    
    $wp_customize->add_control( 'enable_contact_select_box', array(
        'settings' => 'okay_theme_customizer_enable_contact',
        'label'   => 'Enable Contact Section',
        'section' => 'okay_theme_customizer_contact',
        'type'    => 'select',
        'choices'    => array(
            'enabled' => 'Enabled',
            'disabled' => 'Disabled',
        ),
        'priority' => 1
    ));
    
    //Contact Page
	$wp_customize->add_setting('okay_theme_customizer_contact_page', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    
    $wp_customize->add_control( 'contact_page_select_box', array(
        'settings' => 'okay_theme_customizer_contact_page',
        'label'   => 'Contact Page',
        'section' => 'okay_theme_customizer_contact',
        'type'    => 'select',
        'choices' => $options_pages,
    ));
    

	//-----------------  // Live Preview  //-----------------//
	
	$wp_customize->get_setting('blogname')->transport='postMessage';
	
	if ( $wp_customize->is_preview() && ! is_admin() )
	add_action( 'wp_footer', 'okay_customizer_preview', 21);
	
	function okay_customizer_preview() {
		?>
		<script type="text/javascript">
		( function( $ ){
		
		wp.customize('okay_theme_customizer_main_title',function( value ) {
			value.bind(function(to) {
				$('.intro-text h2').html(to);
			});
		});
		
		wp.customize('okay_theme_customizer_sub_title',function( value ) {
			value.bind(function(to) {
				$('.intro-text h3').html(to);
			});
		});
		
		wp.customize('okay_theme_customizer_portfolio_title',function( value ) {
			value.bind(function(to) {
				$('#portfolio .section-title h2').html(to);
			});
		});
		
		wp.customize('okay_theme_customizer_portfolio_sub_title',function( value ) {
			value.bind(function(to) {
				$('#portfolio .section-title h3').html(to);
			});
		});
		
		} )( jQuery )
		</script>
		<?php 
	}
}