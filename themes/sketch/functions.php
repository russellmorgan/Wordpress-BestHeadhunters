<?php

//-----------------------------------  // Load Scripts & Styles //-----------------------------------//

function okay_scripts_styles() {

	//---------------------  // Stylesheets // ---------------------//

	//Main Stylesheet
	wp_enqueue_style( 'sketch_style', get_stylesheet_uri() );

	//Media Queries
	wp_enqueue_style( 'sketch_media_queries', get_template_directory_uri() . "/includes/styles/media-queries.css" );

	//Dark Stylesheet
	if ( get_option('okay_theme_customizer_color_scheme') == 'dark' ) {
		wp_enqueue_style( 'sketch_style_dark', get_template_directory_uri() . "/includes/styles/dark.css");
	}

	//Flexslider CSS
	wp_enqueue_style( 'fancybox_css', get_template_directory_uri() . "/includes/js/flexslider/flexslider.css" );

	//---------------------  // Scripts // ---------------------//

	//Register jQuery
	wp_enqueue_script('jquery');

	//Custom JS
	wp_enqueue_script('custom_js', get_template_directory_uri() . '/includes/js/custom/custom.js', false, false , false);

	//Localize Script
	wp_localize_script('custom_js', 'custom_js_vars', array(
		'template_uri' => get_template_directory_uri(),
		'portfolio_sort' => get_option('okay_theme_customizer_enable_portfolio_sort'),
		)
	);

	if ( get_option('okay_theme_customizer_enable_portfolio_sort') == 'enabled' ) {
		//Quicksand Easing
		wp_enqueue_script('easing_js', get_template_directory_uri() . '/includes/js/quicksand/jquery.easing.1.3.js', false, false , true);

		//Quicksand Script
		wp_enqueue_script('quicksand_js', get_template_directory_uri() . '/includes/js/quicksand/quicksand.js', false, false , true);
	}

	//jQuery BBQ
  	wp_enqueue_script('bbq_js', get_template_directory_uri() . '/includes/js/bbq/jquery-bbq.min.js', array('jquery'), false , false);

	//Flexslider Script
	wp_enqueue_script('flexslider_js', get_template_directory_uri() . '/includes/js/flexslider/jquery.flexslider-min.js', false, false , true);

	//Waypoints Script
	wp_enqueue_script('waypoints_js', get_template_directory_uri() . '/includes/js/waypoints/waypoints.min.js', false, false , true);

	//Mobile Menu
	wp_enqueue_script('menu_js', get_template_directory_uri() . '/includes/js/menu/jquery.mobilemenu.js', false, false , true);

	//FidVid
	wp_enqueue_script('fitvid_js', get_template_directory_uri() . '/includes/js/fitvid/jquery.fitvids.js', false, false);

	//---------------------  // Fonts // ---------------------//

	wp_enqueue_style('google_coda', 'http://fonts.googleapis.com/css?family=Coda:400');
    wp_enqueue_style('google_open', 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300');
}
add_action( 'wp_enqueue_scripts', 'okay_scripts_styles' );



//-----------------------------------  // Add Customizer CSS To Header //-----------------------------------//

function customizer_css() {
    ?>
	<style type="text/css">
		a, .commentlist #cancel-comment-reply:before, .blog-author:hover a {
			color: <?php echo '' .get_theme_mod( 'okay_theme_customizer_link', '#22aae3' )."\n";?>;
		}

		#nav .link-active, #nav a:hover, .filter-list li ul li:hover, .intro-text h2, #okay-submit, .flex-control-paging li a.flex-active, .respond-submit, .modal-close, .project-fade, .about-right, .modal blockquote, .mobile-icon, .contact-details, .gallery-item img:hover, .slide-controls a, .wpcf7-submit  {
			background: <?php echo '' .get_theme_mod( 'okay_theme_customizer_accent', '#22aae3' )."\n";?> !important;
		}
	
		/* Customizer CSS */
		<?php echo '' .get_theme_mod( 'okay_theme_customizer_css', '' )."\n";?>
	</style>
    <?php
}
add_action('wp_head', 'customizer_css');



//-----------------------------------  // Add Localization //-----------------------------------//

load_theme_textdomain( 'okay', get_template_directory() . '/includes/languages' );



//-----------------------------------  // Add Customizer To Menu //-----------------------------------//

function okay_customizer_admin() {
	add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' ); 
}
add_action ('admin_menu', 'okay_customizer_admin');



//-----------------------------------  // Gallery Support //-----------------------------------//

function okay_theme_setup(){
	add_theme_support('okay_themes_gallery_support');
}
add_action('after_setup_theme', 'okay_theme_setup');



//-----------------------------------  // Add Quote Post Format //-----------------------------------//

add_theme_support('post-formats', array( 'gallery'));



//-----------------------------------  // Customizer & Background Support //-----------------------------------//

require_once(dirname(__FILE__) . "/customizer.php");
add_theme_support( 'custom-background' );




//-----------------------------------  // Editor Styles and Shortcodes //-----------------------------------//

require_once(dirname(__FILE__) . "/includes/editor/add-styles.php");


//-----------------------------------  // Custom Excerpt Limit //-----------------------------------//

function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}


//-----------------------------------  // Page Scroll //-----------------------------------//

class pages_from_nav extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth, $args)
    {
         global $wp_query;
    	 $item_output .= $item->object_id;
    	 $item_output .= ',';

          $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
          }
}


//-----------------------------------  // Custom Comment Output //-----------------------------------//

function okay_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">

		<div class="comment-block" id="comment-<?php comment_ID(); ?>">
			<div class="comment-info">
				<div class="comment-author vcard clearfix">
					<?php echo get_avatar( $comment->comment_author_email, 50 ); ?>

					<div class="comment-meta commentmetadata">
						<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
						<div class="clear"></div>
					</div>
				</div>
			</div>

			<div class="comment-text">
				<a class="comment-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'okay'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)','okay'),'  ','') ?>

				<div class="clear"></div>

				<?php comment_text() ?>
				<p class="reply">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</p>
			</div>

			<?php if ($comment->comment_approved == '0') : ?>
			<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','okay') ?></em>
			<?php endif; ?>
		</div>

		<div class="clear"></div>
<?php
}


//-----------------------------------  // Allow Shortcodes in Widgets //-----------------------------------//

add_filter('widget_text', 'do_shortcode');


//-----------------------------------  // Auto Feed Links //-----------------------------------//

add_theme_support( 'automatic-feed-links' );


//-----------------------------------  // Register Menus //-----------------------------------//

add_theme_support( 'menus' );
register_nav_menu('main', 'Main Menu');
register_nav_menu('footer', 'Footer Menu');


//-----------------------------------  // Content Width //-----------------------------------//

if ( ! isset( $content_width ) ) $content_width = 1200;


//-----------------------------------  // Add Image Sizes //-----------------------------------//

add_theme_support('post-thumbnails');
set_post_thumbnail_size( 150, 150, true ); // Default Thumb
add_image_size( 'portfolio-thumb', 760, 479, true ); // Portfolio Thumb
add_image_size( 'full-size', 9999, 9999, true ); // Full width image
add_image_size( 'blog-thumb', 200, 200, true ); // Blog Post Image
add_image_size( 'profile-thumb', 150, 150, true ); // About Profile Image


//-----------------------------------  // Background and Header Support //-----------------------------------//

add_theme_support( 'custom-header' );
add_theme_support( 'custom-background' );


//-----------------------------------  // Register Sidebar Widgets //-----------------------------------//

if ( function_exists('register_sidebars') )

register_sidebar(array(
'name' => 'Social Widgets',
'description' => 'Widgets in this area will be shown in the Social Widgets section.',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '<div class="text-fade"></div></div>'
));

register_sidebar(array(
'name' => 'Footer',
'description' => 'Widgets in this area will be shown in the footer.',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>'
));

register_sidebar(array(
'name' => 'Social Media Icons',
'description' => 'Header widget area for social media icons from the Okay Toolkit.',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>'
));



//-----------------------------------  // Tooltip Pointers //-----------------------------------//

require_once(dirname(__FILE__) . "/includes/pointers/pointers.php");