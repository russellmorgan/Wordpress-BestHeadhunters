<?php

/*-----------------------------------------------------------------------------------*/
/* dribbble Widget
/*-----------------------------------------------------------------------------------*/

add_filter('option_ok_dribbble_title', 'stripslashes');

add_action( 'widgets_init', 'load_ok_dribbble_widget' );

function load_ok_dribbble_widget() {
	register_widget( 'okdribbbleWidget' );
}

class okdribbbleWidget extends WP_Widget {
	function okdribbbleWidget() {
	$widget_ops = array( 'classname' => 'ok-dribbble', 'description' => __('Grab your latest Dribbble shots', 'ok-dribbble') );
	$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ok-dribbble' );
	$this->WP_Widget( 'ok-dribbble', __('Okay Dribbble Widget', 'ok-dribbble'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		
		include_once(ABSPATH . WPINC . '/feed.php');
 
		$playerName = $instance['dribbble_name'];
		$shots = $instance['dribbble_shots'];
	
		if(function_exists('fetch_feed')):
			$rss = fetch_feed("http://dribbble.com/players/$playerName/shots.rss");
			add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', 'return 1800;' ) );
			if (!is_wp_error( $rss ) ) : 
				$items = $rss->get_items(0, $rss->get_item_quantity($shots)); 
			endif;
		endif;
		
		extract( $args );
		$dribbble_title = esc_attr( $instance['dribbble_title'] );
		$dribbble_name = esc_attr( $instance['dribbble_name'] );
		$dribbble_shots = esc_attr( $instance['dribbble_shots'] );
		echo $before_widget;
?>	
	<div class="dribbble-widget">
		<div class="dribbble-icon">J</div>
		
		<h2 class="dribbble-title"><?php echo $instance['dribbble_title']; ?></h2>
		
		<ul class="dribbbles clearfix">
			<?php foreach ( $items as $item ):
				$title = $item->get_title();
				$link = $item->get_permalink();
				$date = $item->get_date('F d, Y');
				$description = $item->get_description();
			
				preg_match("/src=\"(http.*(jpg|jpeg|gif|png))/", $description, $image_url);
				$image = $image_url[1];
			?>
			<li class="dribbble-img"> 
				<a href="<?php echo $link; ?>" class="dribbble-link"><img src="<?php echo $image; ?>" alt="<?php echo $title;?>"/></a> 
		 	</li>
		 	<?php endforeach;?>
	 	</ul>
 	</div>

<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['dribbble_title'] = $new_instance['dribbble_title'];
		$instance['dribbble_name'] = $new_instance['dribbble_name'];
		$instance['dribbble_shots'] = $new_instance['dribbble_shots'];		
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'dribbble_title' => '', 'dribbble_name' => '', 'dribbble_shots' => '') );
		$instance['dribbble_title'] = $instance['dribbble_title'];
		$instance['dribbble_name'] = $instance['dribbble_name'];
		$instance['dribbble_shots'] = $instance['dribbble_shots'];
?>
			
			<p>
				<label for="<?php echo $this->get_field_id('dribbble_title'); ?>"><?php _e('Title:','okay'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('dribbble_title'); ?>" name="<?php echo $this->get_field_name('dribbble_title'); ?>" type="text" value="<?php echo $instance['dribbble_title']; ?>" />
				</label>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('dribbble_name'); ?>"><?php _e('Username:','okay'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('dribbble_name'); ?>" name="<?php echo $this->get_field_name('dribbble_name'); ?>" type="text" value="<?php echo $instance['dribbble_name']; ?>" />
				</label>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('dribbble_shots'); ?>"><?php _e('Number of Shots:','okay'); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('dribbble_shots'); ?>" name="<?php echo $this->get_field_name('dribbble_shots'); ?>" type="text" value="<?php echo $instance['dribbble_shots']; ?>" />
				</label>
			</p>
              
  <?php
	}
}