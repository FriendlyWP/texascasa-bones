<?php 
// set variable to true so we can enqueue scripts when this file is loaded
global $temppart;
$temppart = true;
//query_posts('post_type=resources');
get_header(); ?>
		<script type="text/javascript">
	
		jQuery(document).ready(function($) {
			/* Initialise the DataTable */
			var oTable = $('#pub_table').dataTable( {
				"bPaginate": false,
				"oLanguage": {
					"sSearch": "<h5>Search Local Programs&nbsp;<i class='icon-search icon-large'></i></h5>"
				},
				"aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 2 ] },
                    /*{ "sClass": "mobile_hide_min", "aTargets": [ 'pub_name', 'pub_format' ] },
                    { "sClass": "mobile_hide_max", "aTargets": [ 'pub_topic' ] }*/
                ]
				
			});


			$('div.dataTables_filter').appendTo('#searchTable');

		} );

		</script>

			
			<div id="content">
			
				<div id="inner-content" class="wrap clearfix">
				
				    <div id="main" class="eightcol first clearfix" role="main">
				
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

					    	<?php 
							if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('<p id="breadcrumbs">','</p>');
							} ?>

							
								<?php if (is_post_type_archive()) {
									echo '<h1 class="page-title">';
								 	post_type_archive_title(); 
								 	echo '</h1>';
								 } 
								 ?>
							</h1>

						
						    <table id="pub_table" width="100%" class="pretty">

						    	<thead>
						    		<tr>
						    			<th class="program_title">Program Name</th>
						    			<th class="program_city">City</th>
						    			<th class="program_counties">Counties</th>
						    		</tr>
						    	</thead>

						    	<tbody>
					    		<?php if (have_posts()) {
										while (have_posts()) : the_post();
										
								        $casa_city = get_custom_field_value('casa_city', false);
								        $casa_counties = get_custom_field_value('casa_counties', false);
						    		?>
						    		<tr>
						    			<td class="resourcetd"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></td>
						    			<td><?php // PROGRAM CITY
									        	echo $casa_city;
								        ?></td>
								        <td><?php // PROGRAM COUNTIES
									        echo $casa_counties;
								        ?></td>
						    		</tr>
						    		<?php
						    		endwhile; ?>	
						    	</tbody>
						    	<tfoot>
						    		<tr>
						    			<th class="program_title">Program Name</th>
						    			<th class="program_city">City</th>
						    			<th class="program_counties">Counties</th>
						    		</tr>
						    	</tfoot>
						    </table>

						   
					    </article> <!-- end article -->
					
					        
					    <?php }  else { ?>
					
    					    <article id="post-not-found" class="hentry clearfix">
    						    <header class="article-header">
    							    <h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
    					    	</header>
    						    <section class="entry-content">
    							    <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
        						</section>
    	    					<footer class="article-footer">
    		    				    <p><?php _e("This is the error message in the custom posty type archive template.", "bonestheme"); ?></p>
    			    			</footer>
    				    	</article>
					
					    <?php }  ?>
			
    				</div> <!-- end #main -->
    
	    			<div id="sidebar1" class="sidebar fourcol last clearfix" role="complementary">
	    				
	    				<p id="searchTable" class="clearfix"></p>

						<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

							<?php dynamic_sidebar( 'sidebar1' ); ?>

						<?php else : ?>
		
							

						<?php endif; ?>
	    			</div>
                
                </div> <!-- end #inner-content -->
                
			</div> <!-- end #content -->

<?php get_footer(); ?>