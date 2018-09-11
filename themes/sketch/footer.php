			<div id="footer" class="clearfix">
				<div class="footer-inside">
					<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer') ) : else : ?>		
					<?php endif; ?>
					
					<ul class="copyright">
						<?php if ( get_option('okay_theme_customizer_logo') ) { ?>
							<li class="footer-logo">
								<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><img class="logo" src="<?php echo get_option('okay_theme_customizer_logo'); ?>" alt="<?php bloginfo('name'); ?>"/></a>
							</li>
						<?php } else { ?>
							<li class="footer-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></li>
							<li class="footer-desc"><?php bloginfo('description'); ?></li>
						<?php } ?>
					</ul>
				</div><!-- footer inside -->
			</div><!-- footer -->
		</div><!-- wrapper -->
	
	<?php wp_footer(); ?>
</body>
</html>