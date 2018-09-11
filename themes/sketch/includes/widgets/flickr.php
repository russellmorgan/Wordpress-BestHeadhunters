<?php

/*-----------------------------------------------------------------------------------*/
/* Flickr Widget
/*-----------------------------------------------------------------------------------*/

function ok_flickr_jquery() {
	wp_enqueue_script('jquery');
}
add_action('widgets_init','ok_flickr_jquery');

class ok_Flickr extends WP_Widget {

	// Constructor
	function ok_Flickr() {
	    $widget_ops = array( 'classname' => 'flickr', 'description' => __('Pull your latest Flickr photos', 'okay') );
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ok-flickr-widget' );
		$this->WP_Widget('ok-flickr-widget', __('Okay Flickr Widget', 'okay'), $widget_ops, $control_ops);
	}

	// Displays/outputs the widget
	function widget( $args, $instance ) {
 		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		$flickrid = $instance['flickrid'];
		$flickrcount = $instance['flickrcount'];

		echo $before_widget; ?>
		<div class="flickr-widget">
			<div class="flickr-icon">
				<div class="flickr"><span class="cyan"></span><span class="magenta"></span></div>
			</div>
			
			<?php if ( $title ) echo $before_title . $title . $after_title; ?>
			
			<ul id="flickr-<?php echo $args['widget_id']; ?>" class="flickr-photos">

			<?php

			// If the user's set their flickrid, grab their latest pics
			if ($flickrid != ''){

				$images = array();
				$regx = "/<img(.+)\/>/";

				// Set up the flickr feed URL and retrieve it
				$rss_url = 'http://api.flickr.com/services/feeds/photos_public.gne?ids='.$flickrid.'&lang=en-us&format=rss_200';
				$flickr_feed = simplexml_load_file( $rss_url );
				
				// Store images from the feed in an array
				foreach( $flickr_feed->channel->item as $item ) {
					preg_match( $regx, $item->description, $matches );
					
					$images[] = array(							  
							  'link' => $item->link,
							  'thumb' => $matches[ 0 ]
							);
				}

				// Loop through the images and display the number they wish to show
				$image_count = 0;
				if ( $flickrcount == '' ) $flickrcount = 5;

				foreach( $images as $img ) {
					if ($image_count < $flickrcount ){
						$img_tag = str_replace("_m", "_b", $img[ 'thumb' ] );
						echo '<li><a href="' . $img[ 'link' ] . '">' . $img_tag . '</a></li>';
						$image_count++;
					}
				}

			}//end if ($flickrid)

			?>				
			</ul>				
			
			
			<div style="clear:both;"></div>
			<a target="_blank" class="flickr-more" href="http://flickr.com/photos/<?php echo $flickrid; ?>" title=""><?php _e('More Photos &rarr;','okay'); ?></a></div>
			
			<?php
		echo $after_widget;	
  }

	// Updating the widget
	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title']);
		$instance['flickrid'] = strip_tags( $new_instance['flickrid']);
		$instance['flickrcount'] = strip_tags( $new_instance['flickrcount']);

		return $instance;
	}

	function form( $instance ) {
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','okay'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('flickrid'); ?>"><?php _e('Your Flickr User ID:','okay'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('flickrid'); ?>" name="<?php echo $this->get_field_name('flickrid'); ?>" value="<?php echo $instance['flickrid']; ?>" />
	 		<small>Don't know your ID? Head on over to <a href="http://idgettr.com">idgettr</a> to find it.</small>
	 	</p>

	 	<p>
			<label for="<?php echo $this->get_field_id('flickrcount'); ?>"><?php _e('No. of Photos:','okay'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('flickrcount'); ?>" name="<?php echo $this->get_field_name('flickrcount'); ?>" value="<?php echo $instance['flickrcount']; ?>" />
		</p>
		
		<?php
	}
}

add_action('widgets_init','load_ok_flickr');

function load_ok_flickr() {
	register_widget('ok_Flickr');
}
?>