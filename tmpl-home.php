<?php
/*
Template Name: Home Page
*/
?>

<?php get_header(); ?>

			<div class="wide">
				<div class="wrap">

				<script type="text/javascript" language="javascript">
                    jQuery(document).ready(function($) {
                    	var n = 1
                        $('.flexslider').flexslider({
                        	//namespace: "mmflex-",
                        	controlsContainer: ".flexslider",
                          animation: "fade",
                          slideshowSpeed: 10000,
                          directionNav: true,
                          controlNav: false,
                          animationLoop: true,
                          prevText: "",
                          nextText: "",
	                    });
	                });
                </script>
				
				<?php
			    	if (function_exists('get_field') ) {
			    	 	if (get_field('frames')) {
			    	 	echo '<div class="flexslider">';
			    	 	echo '<ul class="slides">';	
							 
							while(has_sub_field('frames')):
								$full_width = get_sub_field('full_width');
								$overlay_color = get_sub_field('overlay_color');
								$overlay_heading_text = get_sub_field('overlay_heading_text');
								$overlay_smaller_text = get_sub_field('overlay_smaller_text');
								$button_text = get_sub_field('button_text');
								$button_destination = get_sub_field('button_destination');
								$slide_image = get_sub_field('slide_image');
								if ( ($full_width == 1) && !wp_is_mobile() ) {
		    	 					$image_info =  wp_get_attachment_image_src( $slide_image, 'home-frame-wide' );
		    	 					$overlay_color = $overlay_color . ' trans';
		    	 					$img_width = "wide";
		    	 				} else {
		    	 					$image_info =  wp_get_attachment_image_src( $slide_image, 'home-frame' );
		    	 					$overlay_color = $overlay_color;
		    	 					$img_width = "narrow";
		    	 				}
		    	 		 		
		    	 		 		echo '<li><a href="' . $button_destination . '"><img src="' . $image_info[0] . '" class="' . $img_width . '" /></a><span class="overlay ' . $overlay_color . '"><span><h3>' . $overlay_heading_text . '</h3><p>' .  $overlay_smaller_text. '</p><a href="' . $button_destination . '" class="button red">' . $button_text . '</a></span></span></li>';
			    	 		endwhile; 
			    	 	echo '</ul>';
						echo '</div>';
						}
					}
			    	?>
			    </div>
			</div>

			    <div id="content">
			
					<div id="inner-content" class="wrap clearfix">
			
					    <div id="main" class="eightcol first clearfix" role="main">

						    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
						    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

						    	
							    <section class="entry-content clearfix" itemprop="articleBody">
							    	<div class="main-content clearfix">
							    		
								    	<?php
								    	if ( function_exists('get_custom_field_value') ){
								    		$home_content_area = get_custom_field_value('home_content_area', false);
								    		$right_column = get_custom_field_value('right_column', false);

								    		
								    		
								    		// MAIN TEXT
									        if ($home_content_area) {
									     	   	echo apply_filters( 'the_content', html_entity_decode( $home_content_area, ENT_QUOTES, 'UTF-8' ) );
									    	}


									    	//echo '<div class="secondcol">';
								    		
								    		// MAIN SIDEBAR
									        /* if ($right_column) {
									     	   	echo apply_filters( 'the_content', html_entity_decode( $right_column, ENT_QUOTES, 'UTF-8' ) );
									    	} */
									    	//get_sidebar();
									    	//echo '</div>';

										}
										?>
									</div><!-- close .about-and-topics -->

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