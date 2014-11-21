<?php get_header(); ?>
			
	<div id="content">
	
		<div id="inner-content" class="wrap clearfix">
	
		    <div id="main" class="eightcol first clearfix" role="main">

			    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
				
				    <header class="article-header">
					<?php 
								if ( function_exists('yoast_breadcrumb') ) {
									yoast_breadcrumb('<p id="breadcrumbs"><a href="' . home_url() . '">Home</a> &raquo; ','</p>');
								} ?>
					    <h1 class="page-title custom-post-type-title"><?php the_title(); ?></h1>
						
				    </header> <!-- end article header -->
			
				    <section class="entry-content clearfix">
				    	<div class="fyn-info clearfix">
					    <?php 
					    if ( function_exists('get_custom_field_value') ) {
					    	$casa_address = get_custom_field_value('casa_address', false);
					    	$casa_url = get_custom_field_value('casa_url', false);
					    	$casa_city = get_custom_field_value('casa_city', false);
					    	$casa_phone = get_custom_field_value('casa_phone', false);
					    	$casa_email = get_custom_field_value('casa_email', false);
					    	$casa_email = antispambot($casa_email);
					    	$casa_counties = get_custom_field_value('casa_counties', false);
				            
					    	if ( $casa_address ) {
					    		echo '<span class="title">Address:</span>';
					    		echo '<span class="data">' . apply_filters( 'the_content', html_entity_decode( $casa_address ) ) . '</span>';
					    	}

					    	if ( $casa_phone ) {
					    		echo '<span class="title">Phone:</span>';
					    		echo '<span class="data">' . $casa_phone . '</span>';
					    	}

					    	if ( $casa_email ) {
					    		echo '<span class="title">Email:</span>';
					    		echo '<span class="data"><a href="mailto:' . $casa_email . '">' . $casa_email . '</a></span>';
					    	}

					    	if ( $casa_url ) {
					    		echo '<span class="title">Website:</span>';
					    		echo '<span class="data"><a href="' . $casa_url . '" target="_blank">' . $casa_url . '</a></span>';
					    	}

					    	if ( $casa_counties ) {
					    		echo '<span class="title">Counties:</span>';
					    		echo '<span class="data">' . $casa_counties . '</span>';
					    	}
				            
					    }
					    ?>
						</div>

					    <?php //the_content(); ?>	
					    <?php if (function_exists('gravity_form')) { 
					    		gravity_form('Contact This Local CASA Program', true, true, false, '', false, 34 ); 
					    	}
					    ?>			
				    </section> <!-- end article section -->
			
			    </article> <!-- end article -->
			
			    <?php endwhile; ?>			
			
			    <?php else : ?>
			
					<article id="post-not-found" class="hentry clearfix">
						<header class="article-header">
							<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
						</header>
						<section class="entry-content">
							<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
						</section>
						<footer class="article-footer">
						    <p><?php _e("This is the error message in the single-custom_type.php template.", "bonestheme"); ?></p>
						</footer>
					</article>
			
			    <?php endif; ?>
	
		    </div> <!-- end #main -->

		    <?php get_sidebar(); ?>
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>