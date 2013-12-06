<?php

add_action('widgets_init', create_function('', 'return register_widget("WPSEO_Show_Address");'));

class WPSEO_Show_Address extends WP_Widget {
    /** constructor */
    function WPSEO_Show_Address() {
        $widget_options = array( 
        	'classname' => 'WPSEO_Show_Address',
        	'description' => __('Shows address of locations in Schema.org standards.', 'wordpress-seo') 
        );
        parent::WP_Widget( false, $name = __('WP SEO - Show Address', 'wordpress-seo'), $widget_options );
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );

		$title = apply_filters('widget_title', $instance['title']);
		$location_id = !empty( $instance['location_id'] ) ? $instance['location_id'] : '';
		$show_country = !empty( $instance['show_country'] ) && $instance['show_country'] == '1';
		$show_state = !empty( $instance['show_state'] ) && $instance['show_state'] == '1';
		$show_phone = !empty( $instance['show_phone'] ) && $instance['show_phone'] == '1';
		$show_opening_hours = !empty( $instance['show_opening_hours'] ) && $instance['show_opening_hours'] == '1';
		$show_oneline = !empty( $instance['show_oneline'] ) && $instance['show_oneline'] == '1';

		echo $before_widget; 

		if( !empty( $title ) )
			echo $before_title . $title . $after_title; 
		
		$args = array(
			'id' => $location_id,
			'show_country' => $show_country,
			'show_state' => $show_state,
			'show_phone' => $show_phone,
			'show_opening_hours' => $show_opening_hours,
			'oneline' => $show_oneline,
			'from_widget' => true,
			'widget_title' => $title,
			'before_title' => $before_title,
			'after_title' => $after_title
		);

		echo wpseo_local_show_address( $args );
		
		echo $after_widget;
    }


    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = esc_attr( $new_instance['title'] );
		$instance['location_id'] = esc_attr( $new_instance['location_id'] );
		$instance['show_country'] = esc_attr( $new_instance['show_country'] );
		$instance['show_state'] = esc_attr( $new_instance['show_state'] );
		$instance['show_phone'] = esc_attr( $new_instance['show_phone'] );
		$instance['show_opening_hours'] = esc_attr( $new_instance['show_opening_hours'] );
		$instance['show_oneline'] = esc_attr( $new_instance['show_oneline'] );
		
		return $instance;
	}

    /** @see WP_Widget::form */
    function form($instance) {
    	$options = get_option( "wpseo_local" );
		$title = !empty($instance['title']) ? esc_attr($instance['title']) : '';
		$location_id = !empty($instance['location_id']) ? esc_attr($instance['location_id']) : '';
		$show_country = !empty($instance['show_country']) && esc_attr($instance['show_country']) == '1';
		$show_state = !empty($instance['show_state']) && esc_attr($instance['show_state']) == '1';
		$show_phone = !empty($instance['show_phone']) && esc_attr($instance['show_phone']) == '1';
		$show_opening_hours = !empty($instance['show_opening_hours']) && esc_attr($instance['show_opening_hours']) == '1';
		$show_oneline = !empty($instance['show_oneline']) && esc_attr($instance['show_oneline']) == '1';
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
		
		<p>
			<label for="<?php echo $this->get_field_id('show_country'); ?>">
				<input id="<?php echo $this->get_field_id('show_country'); ?>" name="<?php echo $this->get_field_name('show_country'); ?>" type="checkbox" value="1" <?php echo !empty($show_country) ? ' checked="checked"' : ''; ?> />
				<?php _e('Show country', 'wordpress-seo'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_state'); ?>">
				<input id="<?php echo $this->get_field_id('show_state'); ?>" name="<?php echo $this->get_field_name('show_state'); ?>" type="checkbox" value="1" <?php echo !empty($show_state) ? ' checked="checked"' : ''; ?> />
				<?php _e('Show state', 'wordpress-seo'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_phone'); ?>">
				<input id="<?php echo $this->get_field_id('show_phone'); ?>" name="<?php echo $this->get_field_name('show_phone'); ?>" type="checkbox" value="1" <?php echo !empty($show_phone) ? ' checked="checked"' : ''; ?> />
				<?php _e('Show phone number', 'wordpress-seo'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_opening_hours'); ?>">
				<input id="<?php echo $this->get_field_id('show_opening_hours'); ?>" name="<?php echo $this->get_field_name('show_opening_hours'); ?>" type="checkbox" value="1" <?php echo !empty($show_opening_hours) ? ' checked="checked"' : ''; ?> />
				<?php _e('Show opening hours', 'wordpress-seo'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_oneline'); ?>">
				<input id="<?php echo $this->get_field_id('show_oneline'); ?>" name="<?php echo $this->get_field_name('show_oneline'); ?>" type="checkbox" value="1" <?php echo !empty($show_oneline) ? ' checked="checked"' : ''; ?> />
				<?php _e('Show address in one line', 'wordpress-seo'); ?>
			</label>
		</p>
        <?php
	}

}
 

?>