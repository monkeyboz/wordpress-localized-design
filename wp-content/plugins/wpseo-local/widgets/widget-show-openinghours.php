<?php

add_action('widgets_init', create_function('', 'return register_widget("WPSEO_Show_OpeningHours");'));

class WPSEO_Show_OpeningHours extends WP_Widget {
    /** constructor */
    function WPSEO_Show_OpeningHours() {
        $widget_options = array( 
        	'classname' => 'WPSEO_Show_OpeningHours',
        	'description' => __('Shows opening hours of locations in Schema.org standards.', 'wordpress-seo') 
        );
        parent::WP_Widget( false, $name = __('WP SEO - Show Opening hours', 'wordpress-seo'), $widget_options );
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );

		$title = apply_filters('widget_title', $instance['title']);
		$location_id = !empty( $instance['location_id'] ) ? $instance['location_id'] : '';
		
		echo $before_widget; 

		if( !empty( $title ) )
			echo $before_title . $title . $after_title; 
		
		$args = array(
			'id' => $location_id,
			'from_widget' => true,
			'widget_title' => $title,
			'before_title' => $before_title,
			'after_title' => $after_title
		);

		echo wpseo_local_show_opening_hours( $args );
		
		echo $after_widget;
    }


    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = esc_attr( $new_instance['title'] );
		$instance['location_id'] = esc_attr( $new_instance['location_id'] );
		
		return $instance;
	}

    /** @see WP_Widget::form */
    function form($instance) {
    	$options = get_option( "wpseo_local" );
		$title = !empty($instance['title']) ? esc_attr($instance['title']) : '';
		$location_id = !empty($instance['location_id']) ? esc_attr($instance['location_id']) : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wordpress-seo'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<?php if( wpseo_has_multiple_locations() ) { ?>
		<p>
			<label for="<?php echo $this->get_field_id('location_id'); ?>"><?php _e('Location:', 'wordpress-seo'); ?></label> 
			<?php
				$args =  array( 
					'post_type' => 'wpseo_locations',
					'orderby' => 'name',
					'order' => 'ASC',
					'posts_per_page' => -1
				);
				$locations = get_posts( $args );
			?>
			<select name="<?php echo $this->get_field_name('location_id'); ?>" id="<?php echo $this->get_field_id('location_id'); ?>">
				<option value=""><?php _e('Select a location', 'wordpress-seo'); ?></option>
				<?php foreach( $locations as $location ) { ?>
					<option value="<?php echo $location->ID; ?>" <?php selected( $location_id, $location->ID ); ?>><?php echo get_the_title( $location->ID ); ?></option>
				<?php } ?>
			</select>
		</p>
		<?php } ?>
		
        <?php
	}

}
 

?>