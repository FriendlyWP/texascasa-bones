<?php
/**
 * The template for displaying a single event
 *
 * Please note that since 1.7, this template is not used by default. You can edit the 'event details'
 * by using the event-meta-event-single.php template.
 *
 * Or you can edit the entire single event template by creating a single-event.php template
 * in your theme. You can use this template as a guide.
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
 * @since 1.0.0
 */

//Call the template header
get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap clearfix">

		<div id="main" class="eightcol first clearfix" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">
				<?php 
				if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p id="breadcrumbs"><a href="' . home_url() . '">Home</a> &raquo; ','</p>');
				} ?>
				<!-- Display event title -->
				<h1 class="entry-title"><?php the_title(); ?></h1>

			</header><!-- .entry-header -->
	
			<div class="entry-content">
				<!-- Get event information, see template: event-meta-event-single.php -->
				<?php eo_get_template_part('event-meta','event-single'); ?>

				<!-- The content or the description of the event-->
				<?php the_content(); ?>
			</div><!-- .entry-content -->

			<?php 
			 if ( taxonomy_exists('audiences') ) {
			 	$audiences = get_the_term_list( $post->ID, 'audiences', '<span class="list">', '</span><span class="list">', '</span>');
			 }
		    if ( taxonomy_exists('topics') ) {
		        $topics = get_the_term_list( $post->ID, 'topics', '<span class="list">', '</span><span class="list">', '</span>'); 
		     }
		    if ( taxonomy_exists('libraries') ) {
		        $libraries = get_the_term_list( $post->ID, 'libraries', '<span class="list">', '</span><span class="list">', '</span>'); 
		    }
		    
				//var_dump( get_field('event_resources') );
				$posts = get_custom_field_value('event_resources', false);

				if( $posts || $audiences || $topics ) { ?>
				<footer class="article-footer">
				<?php if ($posts) { ?>
				<h5>Event Resources</h5>
					<ul>
					<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
						<?php setup_postdata($post); ?>
					    <li>
					    	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					    </li>
					<?php endforeach; ?>
					</ul>
					<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php }
				if ( $audiences || $topics || $libraries ) { ?>
					<h5>Additional resources</h5>
					<?php 
						
						if ($audiences) {
							echo '<h6>Resources for</h6><span>' .  $audiences . '</span><br />';
						} 
						if ($topics) {
							echo '<h6>Covering the Topics</h6><span>' .  $topics . '</span><br />';
						}
						if ($libraries) {
							echo '<h6>Within </h6><span>' .  $libraries . '</span><br />';
						} 
						
				}
			}
				
				?>
				
			</footer> <!-- end article footer -->

			</article><!-- #post-<?php the_ID(); ?> -->
		

		<?php endwhile; // end of the loop. ?>
				</div> <!-- end #main -->
    
					<?php get_sidebar(); ?>

				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>