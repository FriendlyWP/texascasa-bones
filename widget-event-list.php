<?php
/**
 * The template is used for displaying the Event List widget if the placeholder option isn't used.
 *
 * You can use this to edit how the output of the event list widget. For the shortcode [eo_events] see shortcode-event-list.php
 *
 * For a list of available functions (outputting dates, venue details etc) see http://wp-event-organiser.com/documentation/function-reference/
 *
 ***************** NOTICE: *****************
 *  Do not make changes to this file. Any changes made to this file
 * will be overwritten if the plug-in is updated.
 *
 * To overwrite this template with your own, make a copy of it (with the same name)
 * in your theme directory. See http://wp-event-organiser.com/documentation/editing-the-templates/ for more information
 *
 * WordPress will automatically prioritise the template in your theme directory.
 ***************** NOTICE: *****************
 *
 * @package Event Organiser (plug-in)
 * @since 1.7
 */
global $eo_event_loop,$eo_event_loop_args;

//DEFAULT Date % Time format for events
//$date_format = get_option('date_format');
//$time_format = get_option('time_format');

// MKM custom Date % Time format for events (see http://www.php.net/manual/en/function.date.php)
$date_format = 'M d';
$time_format = 'ga';

//The list ID / classes
$id = ( $eo_event_loop_args['id'] ? 'id="'.$eo_event_loop_args['id'].'"' : '' );
$classes = $eo_event_loop_args['class'];

// determine if the widget is on an archive page
if ( is_tax() ) {
		$curr_tax = get_query_var( 'taxonomy' );
	//	$curr_term = $wp_query->queried_object->slug;
//	$curr_term_name = $wp_query->queried_object->name;

	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
}

?>

<?php if( $eo_event_loop->have_posts() ): ?>
	<?php $count = 0;
	$served = false; ?>

	<?php if ( is_tax () ) {
		echo '<h5 class="events-sub"><span>Related to</span><br />' . $term->name . '</h5>';
		 ?>

	<ul id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($classes);?>" >

		<?php while( $eo_event_loop->have_posts() ): $eo_event_loop->the_post(); ?>

			<?php 
				if ( has_term( $term->slug, $curr_tax, $eo_event_loop->post->ID ) ) {
					$count++;
					if ( $count <= 5 ) {
						$served=true;
				$startdate = eo_get_the_start('d/m/Y');
				$enddate = eo_get_the_end('d/m/Y');

				$startmonth = eo_get_the_start('m/Y');
				$endmonth = eo_get_the_end('m/Y');


				//$end = eo_get_the_end($format);

				if ( eo_is_all_day() ) { // if an all-day event, show just date
					$format = $date_format;
					$start = eo_get_the_start($format);
					$end = '';
				} elseif ( $startdate == $enddate ) { // if a single day event, show time span
					$format = $date_format.' '.$time_format;
					$start = eo_get_the_start($format);
					$end = '&ndash;' . eo_get_the_end($time_format);
				} else { // if event spans days, show only dates not times
					$format = $date_format;
					if ( $startmonth == $endmonth ) {
						$endformat = ('d');
					} else {
						$endformat = $date_format;
					}

					$start = eo_get_the_start($format);
					$end = '&ndash;';
					$end .= eo_get_the_end($endformat);
				}

				// Categories with classes on links
				$cats = get_the_terms(get_the_ID(),'event-category');
				if ( $cats && ! is_wp_error( $cats ) ) {
					$cat_links = array();
					foreach ( $cats as $cat ) {
						$link = get_term_link($cat);
						$cat_links[] = '<a href="' . $link . '" class="ew-catlink ew-' . $cat->slug . '">' . $cat->name . '</a>';
					}
					$cat_list = join( "", $cat_links );
				}
				
			?>

			<li class="clearfix <?php //echo esc_attr(implode(' ',$eo_event_classes)); ?>" ><span class="e-date"><?php echo $start . $end; ?></span>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="e-title"><?php the_title(); ?></a><span class="cats"><?php echo $cat_list; ?></span>
			</li>
			
		<?php  } 
	} 
		endwhile; 
	
		if ( $served == false ) {
			echo "Sorry, there aren't any upcoming events realted to " . $term->name . ".";
		} ?>
			</ul>
		<?php 
		} else { ?>

			<ul id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($classes);?>" > 

		<?php while( $eo_event_loop->have_posts() ): $eo_event_loop->the_post(); ?>
		<?php
			//Generate HTML classes for this event
					$count++;
					if ( $count <= 5 ) {
				$eo_event_classes = eo_get_event_classes(); 

				$startdate = eo_get_the_start('d/m/Y');
				$enddate = eo_get_the_end('d/m/Y');

				$startmonth = eo_get_the_start('m/Y');
				$endmonth = eo_get_the_end('m/Y');


				//$end = eo_get_the_end($format);

				if ( eo_is_all_day() ) { // if an all-day event, show just date
					$format = $date_format;
					$start = eo_get_the_start($format);
					$end = '';
				} elseif ( $startdate == $enddate ) { // if a single day event, show time span
					$format = $date_format.' '.$time_format;
					$start = eo_get_the_start($format);
					$end = '&ndash;' . eo_get_the_end($time_format);
				} else { // if event spans days, show only dates not times
					$format = $date_format;
					if ( $startmonth == $endmonth ) {
						$endformat = ('d');
					} else {
						$endformat = $date_format;
					}

					$start = eo_get_the_start($format);
					$end = '&ndash;';
					$end .= eo_get_the_end($endformat);
				}

				// Categories with classes on links
				$cats = get_the_terms(get_the_ID(),'event-category');
				if ( $cats && ! is_wp_error( $cats ) ) {
					$cat_links = array();
					foreach ( $cats as $cat ) {
						$link = get_term_link($cat);
						$cat_links[] = '<a href="' . $link . '" class="ew-catlink ew-' . $cat->slug . '">' . $cat->name . '</a>';
					}
					$cat_list = join( "", $cat_links );
				}
				
			?>

			<li class="clearfix <?php // echo esc_attr(implode(' ',$eo_event_classes)); ?>" ><span class="e-date"><?php echo $start . $end; ?></span>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="e-title"><?php the_title(); ?></a><span class="cats"><?php echo $cat_list; ?></span>
			</li>
		<?php }
		endwhile; ?>
		</ul>
	<?php } ?>

	

<?php elseif( ! empty($eo_event_loop_args['no_events']) ): ?>

	<ul id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($classes);?>" > 
		<li class="eo-no-events" > <?php echo $eo_event_loop_args['no_events']; ?> </li>
	</ul>

<?php endif; ?>

<a class="button" href="<?php echo home_url('/events'); ?>">See all upcoming events</a>

