<?php
/*
Template Name: Topics List Page
*/
?>
<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="wrap clearfix">
			
				    <div id="main" class="eightcol first clearfix" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						    <header class="article-header">
							
							    <?php if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('<p id="breadcrumbs">','</p>');
								} ?>

								<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
						    </header> <!-- end article header -->
					
						    <section class="entry-content clearfix" itemprop="articleBody">
							    <?php the_content(); ?>
							    

							    <?php 
							    $args = array( 'orderby' => 'name' );

								$terms = get_terms('topics', $args);

								$count = count($terms); $i=0;
								if ($count > 0) {
								    echo '<ul class="my_tag_archive">';
								    foreach ($terms as $term) {
								        $i++;
								    	$term_list .= '<li><a class="term-title" href="'. home_url() . '/learning-center/resources/topics/' . $term->slug . '" title="' . sprintf(__('View all resources in the topic %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a><span>'. $term->description . '</span>';
								    	if ($count != $i) $term_list .= '</li>'; else $term_list .= '</li></ul>';
								    }
								    echo $term_list;
								} 
								?>
							</section> <!-- end article section -->
						
					    </article> <!-- end article -->
					
					    <?php endwhile; else : ?>
					
    					    <article id="post-not-found" class="hentry clearfix">
    					    	<header class="article-header">
    					    		<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
    					    	</header>
    					    	<section class="entry-content">
    					    		<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
    					    	</section>
    					    	<footer class="article-footer">
    					    	    <p><?php _e("This is the error message in the page.php template.", "bonestheme"); ?></p>
    					    	</footer>
    					    </article>
					
					    <?php endif; ?>
			
    				</div> <!-- end #main -->
    
				    <?php get_sidebar(); ?>
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>