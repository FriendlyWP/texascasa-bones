<?php get_header(); ?>
			
	<div id="content">
	
		<div id="inner-content" class="wrap clearfix">
	
		    <div id="main" class="eightcol first clearfix" role="main">

			    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
				
				    <header class="article-header">
						<?php 
							if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('<p id="breadcrumbs"><a href="' . home_url() . '">Home</a> &raquo; <a href="/learning-center">Learning Center</a> &raquo; ','</p>');
							} ?>

					    <h1 class="single-title custom-post-type-title"><?php the_title(); ?></h1>
				
				    </header> <!-- end article header -->
			
				    <section class="entry-content clearfix">
					
					    <?php the_content(); ?>

					    <?php 
					    	$libraries = get_the_term_list( $post->ID, 'libraries', '<span class="list">', '</span><span class="list">', '</span>');
					        $audiences = get_the_term_list( $post->ID, 'audiences', '<span class="list">', '</span><span class="list">', '</span>');
					        $topics = get_the_term_list( $post->ID, 'topics', '<span class="list">', '</span><span class="list">', '</span>');
					        $types = get_the_term_list( $post->ID, 'types', '<span class="list">', '</span><span class="list">', '</span>');
					        $tags = get_the_term_list( $post->ID, 'post_tag', '<span class="list">', '</span><span class="list">', '</span>');
					    ?>

					    <footer class="article-footer">
							<h5>About this resource</h5>
							<?php 
							if ($libraries) {	
								echo '<h6>Libraries:</h6><span>' .  $libraries . '</span>';
							}
							if ($audiences) {
								echo '<h6>Target Audiences:</h6><span>' .  $audiences . '</span>';
								}
							if ($topics) {
								echo '<h6>Topics:</h6><span>' .  $topics . '</span>';
								}
							if ($tags) {
								echo '<h6>Tagged:</h6><span>' .  $tags . '</span>';
							}

							if ($types) {
								echo '<h6>Resource Types:</h6><span>' .  $types . '</span>';
							}
							 
							?>
						</footer> <!-- end article footer -->
			
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