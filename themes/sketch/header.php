<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0" />

	<title><?php wp_title( '|', true, 'right' ); ?><?php echo bloginfo( 'name' ); ?></title>

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" />

	<!--[if lte IE 9]>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/includes/styles/ie.css" media="screen"/>
	<![endif]-->

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="overlay"></div>
	
	<div id="wrapper">
			<div id="header">
				<div id="header-inside" class="clearfix">

					<!-- grab the logo -->
					<?php if ( get_option('okay_theme_customizer_logo') ) { ?>
						<h1 class="logo">
							<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><img class="logo" src="<?php echo get_option('okay_theme_customizer_logo'); ?>" alt="<?php the_title(); ?>" /></a>
						</h1>
					<?php } else { ?>
						<!-- otherwise show the site title -->
						<div class="logo-text">
						    <h1><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo('name'); ?></a></h1>
						</div>
					<?php } ?>

					<div class="mobile-stick">
						<div id="icons">
							<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Social Media Icons') ) : else : ?>		
							<?php endif; ?>
						</div>

						<div id="nav">
							<?php wp_nav_menu( array( 'theme_location' => 'main' ) ); ?>
						</div>

						<div class="mobile-icon">
							<img class="icon-menu" src="<?php echo get_template_directory_uri(); ?>/images/list-menu.png" alt="list menu" />
						</div>
					</div><!-- mobile stick -->
				</div><!-- header inside -->
			</div><!-- header -->