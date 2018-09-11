					<div id="modals-wrap">
						<a class="modal-close" href="#">&#215;</a>

						<?php
							// Combine the portfolio and blog post data for the modal box loop
							$portfolio_cat = get_option('okay_theme_customizer_portfolio_cat', 'no entry' );
							$portfolio_query = get_posts( array(
													'numberposts'     => 12,
													'category'        => $portfolio_cat ) );

							$blog_cat = get_option('okay_theme_customizer_blog_cat', 'no entry' );
							$blog_query = get_posts( array(
													'numberposts'     => 24,
													'category'        => $blog_cat ) );

							// Add a "section_tag" property to each blog object to flag it as blog
							foreach ( $blog_query as &$blog ){
								$blog->section_tag = "blog";
							}
							
							// Add a "section_tag" property to each portfolio object to flag it as portfolio
							foreach ( $portfolio_query as &$portfolio ){
								$portfolio->section_tag = "portfolio";
							}
							
							// Merge the updated arrays so we can loop through all posts objects in one batch
							$combined_query = array_merge( $portfolio_query, $blog_query );
						?>
						
						<?php foreach( $combined_query as $post ) : setup_postdata( $post ); ?>

							<?php
								$category = get_the_category();
								$category_slug = $category[0]->slug;
							?>

							<div data-modal="<?php the_ID(); ?>" class="modal type-<?php echo $post->section_tag; ?> modal-<?php the_ID(); ?> modal-<?php echo $category[0]->category_parent;?> modal-<?php echo $category_slug; ?>">

								<div class="modal-next-button">
									<a class="modal-next" href="#"><img class="icon-forward" src="<?php echo get_template_directory_uri(); ?>/images/forward.png" alt="forward" /></a>
								</div>

								<div class="modal-previous-button">
									<a class="modal-previous" href="#"><img class="icon-backward" src="<?php echo get_template_directory_uri(); ?>/images/backward.png" alt="backward" /></a>
								</div>

								<!-- grab the video -->
								<?php if ( get_post_meta($post->ID, 'okvideo', true) ) { ?>
									<div class="video-wrap">
										<div class="okvideo fixed-width">
											<?php echo get_post_meta($post->ID, 'okvideo', true) ?>
										</div>
									</div>
								<?php } else { ?>

									<!-- grab the gallery -->
									<div class="video-wrap">
										<div class="<?php if ( get_post_meta($post->ID, 'fixed-width', true) ) { ?>fixed-width<?php } ?>">
											<?php if (function_exists('okay_gallery')) { okay_gallery(); } ?>
										</div>
									</div>
															
								<?php } ?>

								<div class="modal-inside">
									<div class="modal-left">
										<h3 class="post-title"><?php the_title(); ?></h3>
										<?php the_content(); ?>

										<div style="clear:both;"></div>

										<div class="meta-nav clearfix">
											<a class="modal-next" href="#"><?php _e('Next Post','okay'); ?> <span>&rarr;</span></a>
											<a class="modal-previous" href="#"><span>&larr;</span> <?php _e('Previous Post','okay'); ?></a>
										</div>
										<div style="clear:both;"></div>
									</div>

									<div class="modal-right">
										<div class="modal-sidebar">
											<div class="modal-meta">
												<ul class="modal-meta-links">
											    	<!--<li><span><span class="modal-meta-title"><?php _e('Author','okay'); ?></span> <?php the_author_link(); ?></span></li>-->
											    	<li><span><span class="modal-meta-title"><?php _e('Date','okay'); ?></span> <?php echo get_the_date('m/d/Y'); ?></span></li>

											    	<li>
														<span><span class="modal-meta-title"><?php _e('Category','okay'); ?></span></span>
														<?php
															foreach((get_the_category()) as $category) {
															    echo $category->cat_name . ' ';
															    echo '&nbsp;';
															}
														?>
													</li>
													<li><span class="modal-meta-title">Apply</span>
														<div class="applywithlinkedinButton"><script type="IN/Apply" data-jobtitle="<?php echo get_the_title($ID);?>" data-email="info@bestheadhunters.com" data-companyname="Best Headhunters"  data-themecolor="#ff0000" data-size=""></script></div>
													</li>
													<?php $posttags = get_the_tags(); if ($posttags) { ?>
														<li>
															<span><span class="modal-meta-title"><?php _e('Tag','okay'); ?></span></span>
															<?php

																$posttags = get_the_tags();
															    if ($posttags) {
															      foreach($posttags as $tag) {
															        echo $tag->name . ' ';
															      }
															    }
															?>
														</li>
													<?php } ?>
											    </ul>
											</div><!-- portfolio meta -->
										</div><!-- sidebar -->
									</div><!-- modal right -->

									<div class="clear"></div>

									<?php if ('open' == $post->comment_status) { ?>
										<?php
										  $withcomments = "1";
										  comments_template();
										?>
									<?php } ?>

								</div><!-- modal inside -->
							</div><!-- modal -->

						<?php endforeach; ?>

				</div><!-- modals wrap -->