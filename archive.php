<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="wrap clearfix">
				
				    <div id="main" class="eightcol first clearfix" role="main">


				    	<?php 
							if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('<p id="breadcrumbs"><a href="' . home_url() . '">Home</a> &raquo; ','</p>');
							} ?>
				
					    <?php if (is_category()) { ?>
						    <h1 class="page-title">
							    <?php single_cat_title(); ?>
					    	</h1>
					    
					    <?php } elseif (is_tag()) { ?> 
						    <h1 class="page-title">
							    <span><?php _e("Posts Tagged:", "bonestheme"); ?></span> <?php single_tag_title(); ?>
						    </h1>
					    
					    <?php } elseif (is_author()) { 
					    	global $post;
					    	$author_id = $post->post_author;
					    ?>
						    <h1 class="page-title">

						    	<span><?php _e("Posts By:", "bonestheme"); ?></span> <?php echo get_the_author_meta('display_name', $author_id); ?>

						    </h1>
					    <?php } elseif (is_day()) { ?>
						    <h1 class="page-title">
	    						<span><?php _e("Daily Archives:", "bonestheme"); ?></span> <?php the_time('l, F j, Y'); ?>
						    </h1>
		
		    			<?php } elseif (is_month()) { ?>
			    		    <h1 class="page-title">
				    	    	<span><?php _e("Monthly Archives:", "bonestheme"); ?></span> <?php the_time('F Y'); ?>
					        </h1>
					
					    <?php } elseif (is_year()) { ?>
					        <h1 class="page-title">
					    	    <span><?php _e("Yearly Archives:", "bonestheme"); ?></span> <?php the_time('Y'); ?>
					        </h1>
					    <?php } ?>

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						    
							
							    <h3 class="search-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							
							    <p class="byline vcard"><?php _e("Posted", "bonestheme"); ?> <time class="updated" datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time></p>
						
						    </header> <!-- end article header -->
					
						    <section class="entry-content clearfix">
						
							   <?php 
									$read_more = ' ... <a class="readmore" href="' . get_permalink() . '" rel="bookmark">Read more</a>'; 
									$content = get_the_content();
									$content = string_limit_words($content, '40');
									$content = $content . $read_more; 
									echo apply_filters( 'the_content', html_entity_decode( $content ) ); 
									?>
					
						    </section> <!-- end article section -->
						
					
					    </article> <!-- end article -->
					
					    <?php endwhile; ?>	
					
					        <?php if (function_exists('bones_page_navi')) { ?>
						        <?php bones_page_navi(); ?>
					        <?php } else { ?>
						        <nav class="wp-prev-next">
							        <ul class="clearfix">
								        <li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries', "bonestheme")) ?></li>
								        <li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;', "bonestheme")) ?></li>
							        </ul>
					    	    </nav>
					        <?php } ?>
					
					    <?php else : ?>
					
    					    <article id="post-not-found" class="hentry clearfix">
    						    <header class="article-header">
    							    <h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
    					    	</header>
    						    <section class="entry-content">
    							    <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
        						</section>
    	    					<footer class="article-footer">
    		    				    <p><?php _e("This is the error message in the archive.php template.", "bonestheme"); ?></p>
    			    			</footer>
    				    	</article>
					
					    <?php endif; ?>
			
    				</div> <!-- end #main -->
    
	    			<?php get_sidebar(); ?>
                
                </div> <!-- end #inner-content -->
                
			</div> <!-- end #content -->

<?php get_footer(); ?>