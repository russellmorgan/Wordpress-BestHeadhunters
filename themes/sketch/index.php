<?php get_header(); ?>

			<div id="main">
				<div id="sections">

					<!-- Big Header -->
					<div id="intro" class="section-wrap">
						<div id="top"></div>

						<div class="header-image-wrap">
							<!-- Get header image from customizer -->
							<?php if ( get_option('okay_theme_customizer_header_image') ) { ?>
								<img class="header-image" src="<?php echo get_option('okay_theme_customizer_header_image'); ?>" alt="<?php the_title(); ?>"/>
							<?php } ?>

							<div class="intro-text <?php if ( get_option('okay_theme_customizer_header_image') ) {} else { ?>no-image<?php } ?>">
								<div class="intro-text-wrap">
									<?php if ( get_option('okay_theme_customizer_main_title')) { ?>
										<h2><?php echo '' .get_option( 'okay_theme_customizer_main_title', '' )."\n";?></h2>
									<?php } ?>

									<?php if ( get_option('okay_theme_customizer_sub_title')) { ?>
										<div style="clear:both;"></div>
										<h3><?php echo '' .get_option( 'okay_theme_customizer_sub_title', '' )."\n";?></h3>
									<?php } ?>
								</div>
							</div><!-- intro text -->

						</div><!-- header image wrap -->
					</div><!-- intro -->


					<!-- About Section -->
					<?php if ( get_option('okay_theme_customizer_enable_about') == 'enabled' ) { ?>
						<div id="about" class="section-wrap">
							<div class="section clearfix">
								<?php
									$about_page = get_option('okay_theme_customizer_about_page', '' );
									query_posts('showposts=1&post_type=page&page_id='.$about_page.'');
								?>

								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

									<div class="section-content">
										<?php if ( has_post_thumbnail() ) { ?>
											<div class="about-left">
												<div class="profile-pic"><?php the_post_thumbnail( 'profile-thumb' ); ?></div>
											</div>
										<?php } ?>

										<div class="about-center <?php if ( get_post_meta($post->ID, 'note', true) ) { ?>about-center-width<?php } ?>">
											<?php the_content(); ?>
										</div>

										<?php if ( get_post_meta($post->ID, 'note', true) ) { ?>
											<div class="about-right">
												<?php echo get_post_meta($post->ID, 'note', true) ?>
											</div>
										<?php } ?>
									</div>

								<?php endwhile; ?>
								<?php endif; ?>
							</div><!-- section -->
						</div><!-- about -->
					<?php } ?>


					<!-- Portfolio Section -->
					<?php if ( get_option('okay_theme_customizer_enable_portfolio') == 'enabled' ) { ?>					
						<div id="portfolio" class="section-wrap portfolio-section">
							<div class="section">

								<div class="section-title">
									<?php if ( get_option('okay_theme_customizer_portfolio_title')) { ?>
										<h2><?php echo '' .get_option( 'okay_theme_customizer_portfolio_title', '' )."\n";?></h2>
									<?php } ?>
								</div>

								<?php if ( get_option('okay_theme_customizer_enable_portfolio_sort') == 'enabled' ) { ?>

								<ul class="filter-list filter clearfix">
									<li>
										<div class="filter-menu"><?php _e('Sort Portfolio','okay'); ?> <span><img src="<?php echo get_template_directory_uri(); ?>/images/list.png" alt="filter menu" /></span></div>
										<ul class="sub-menu">
											<li class="active all-projects"><a href="#"><?php _e('All Projects','okay'); ?></a></li>
											<?php
												$portfolio_cat = get_option('okay_theme_customizer_portfolio_cat', '' );
												$categories = get_categories('child_of='.$portfolio_cat.'');
												
												foreach($categories as $category) {
													echo '<li class="cat-item '.str_replace('-', '', $category->slug).'"><a href="" title="'.$category->name.' projects">'.$category->name.'</a> </li>';
												}
											?>
										</ul>
									</li>
								</ul><!-- filter list -->

								<?php } ?>

								<div class="clear"></div>

								<div class="filter-posts">
									<?php
										$portfolio_cat = get_option('okay_theme_customizer_portfolio_cat', '' );
										query_posts('showposts=12&cat='.$portfolio_cat);
									?>

									<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

										<div data-id="post-<?php the_ID(); ?>" data-type="<?php $categories = get_the_category(); $count = count($categories); $i=1; foreach($categories as $category) {	echo str_replace('-', '', $category->slug); if ($i<$count) echo ' '; $i++;} ?>" class="post-<?php the_ID(); ?> <?php $categories = get_the_category(); foreach($categories as $category) {	echo str_replace('-', '', $category->slug).' '; } ?> project project-box">

											<?php if ( has_post_thumbnail() ) { ?>
												<a class="project-box-image modal-toggle" href="#modal-<?php the_ID(); ?>" title="<?php the_title(); ?>">

													<?php if ( get_post_meta($post->ID, 'okvideo', true) ) { ?>
														<img class="icon-video" src="<?php echo get_template_directory_uri(); ?>/images/icon-video.png" alt="video icon" />
													<?php } ?>
														
													<img class="icon-plus" src="<?php echo get_template_directory_uri(); ?>/images/plus.png" alt="plus" />

													<?php the_post_thumbnail( 'portfolio-thumb' ); ?>
													<div class="project-fade"></div>
												</a>
											<?php } ?>

											<div class="project-box-text">
												<h3><a class="post-modal modal-toggle" rel="post-popup-link" href="#modal-<?php the_ID(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
												<p><?php the_excerpt(); ?></p>
											</div>

											<div class="text-fade"></div>
										</div>

									<?php endwhile; ?>
									<?php endif; ?>

									<div class="clear"></div>
								</div><!-- filter posts -->
							</div><!-- section -->
						</div><!-- portfolio section -->
					<?php } ?>


					<!-- Blog Section -->
					<?php if ( get_option('okay_theme_customizer_enable_blog') == 'enabled' ) { ?>	
						<div id="blog" class="section-wrap">
							<div class="section clearfix">
								<div class="section-content">

									<div class="posts">
										<?php
											$blog_cat = get_option('okay_theme_customizer_blog_cat', '' );
											query_posts('showposts=1&cat='.$blog_cat);
										?>

										<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
											<div class="post-slide">
												<div data-id="post-<?php the_ID(); ?>" data-type="<?php $categories = get_the_category(); $count = count($categories); $i=1; foreach($categories as $category) {	echo str_replace('-', '', $category->slug); if ($i<$count) echo ' '; $i++;} ?>" class="blogpost post-<?php the_ID(); ?> <?php $categories = get_the_category(); foreach($categories as $category) {	echo str_replace('-', '', $category->slug).' '; } ?> post">
													<div <?php post_class(); ?>>
														
														<div class="blog-ribbon">
															<div class="blog-date"><?php echo get_the_date('m.d.y'); ?></div>
														</div>
														
														<div class="blog-heading">
															<h3 class="blog-title launch-modal"><a class="post-modal modal-toggle" rel="post-popup-link" href="#modal-<?php the_ID(); ?>"><?php the_title(); ?></a></h3>
														</div>

														<?php global $more; $more = 0; ?>

														<?php
															if (empty($post->post_excerpt)) {
																the_content('Continue Reading');
															} else {
																the_excerpt();
															}
														?>
													</div>
												</div><!-- post -->
											</div><!-- post slide -->
										<?php endwhile; ?>
										<?php endif; ?>

									</div><!-- posts -->
									
									<div class="posts-list">
										<?php
											$blog_cat = get_option('okay_theme_customizer_blog_cat', '' );
											query_posts('offset=1&showposts=10&cat='.$blog_cat);
										?>
										
										<ul>
											<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
												<li>
													<span><?php echo get_the_date('m.d.y'); ?></span>
													
													<h3 class="blog-title launch-modal">
														<a class="post-modal modal-toggle" rel="post-popup-link" href="#modal-<?php the_ID(); ?>"><?php the_title(); ?></a>
													</h3>
												</li>
											<?php endwhile; ?>
											<?php endif; ?>
										</ul>
									</div>
									
								</div><!-- section-content -->
							</div><!-- section -->
						</div><!-- blog section -->
					<?php } ?>


					<!-- Widgets -->
					<?php if ( get_option('okay_theme_customizer_enable_social') == 'enabled' ) { ?>	
						<div id="social" class="section-wrap">
							<div class="section clearfix">
								<div class="section-content">

									<!-- Widget Section -->
									<div class="social-block">
										<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Social Widgets') ) : else : ?>
										<?php endif; ?>
									</div>

								</div>
							</div><!-- section -->
						</div><!-- social section -->
					<?php } ?>


					<!-- Contact Section -->
					<?php if ( get_option('okay_theme_customizer_enable_contact') == 'enabled' ) { ?>							
						<div id="contact" class="section-wrap">
							<div class="section clearfix">
								
								<div id="contact-left">
									<?php
										$contact_page = get_option('okay_theme_customizer_contact_page', '' );
										query_posts('showposts=1&post_type=page&page_id='.$contact_page.'');
									?>

									<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
										<div class="contact-left <?php if ( get_post_meta($post->ID, 'contactform', true) ) { ?>contact-left-half<?php } ?>">
											<div class="contact-block">
												<div class="section-title">
													<h2><?php the_title(); ?></h2>
												</div>

												<div class="clear"></div>

												<?php the_content(); ?>
											</div><!-- contact block -->
										</div><!-- contact left class -->

									<?php endwhile; ?>
									<?php endif; ?>
								</div><!-- contact left id-->

								<?php
									if ( get_post_meta($post->ID, 'contactform', true) )
									echo do_shortcode(get_post_meta($post->ID, 'contactform', $single = true));
								?>
							</div><!-- section -->
						</div><!-- contact setion -->
					<?php } ?>

				</div><!-- sections -->

				<!-- modal posts -->
				<?php include (TEMPLATEPATH . '/modal.php'); ?>

			</div><!-- main -->

			<?php get_footer(); ?>