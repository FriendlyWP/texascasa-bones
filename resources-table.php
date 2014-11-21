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
				"oLanguage": {
					"sSearch": "<h5>Search Resources&nbsp;<i class='icon-search icon-large'></i></h5>"
				},
				"aoColumnDefs": [
                    { "bVisible": true, "aTargets": [ 'resource_title' ] },
                    { "bSortable": false, "aTargets": [ 'resource_types' ] },
                    { "sClass": "mobile_hide_min", "aTargets": [ 'resource_types', 'resource_audiences' ] },
                    /*{ "sClass": "mobile_hide_max", "aTargets": [ 'pub_topic' ] }*/
                ]
				
			});

			$('#pub_table').dataTable().yadcf([
			    //{column_number : 0},
			    {column_number : 1, column_data_type: "html", html_data_type: "text", filter_container_id: "lib_container", filter_default_label: "", filter_reset_button_text: "&#215;"},
			    {column_number : 2, column_data_type: "html", html_data_type: "text", filter_container_id: "aud_container", filter_default_label: "", filter_reset_button_text: "&#215;"},
			    {column_number : 3, column_data_type: "html", html_data_type: "text", filter_container_id: "topic_container", filter_default_label: "", filter_reset_button_text: "&#215;"},
			]);

			$('div.dataTables_filter').appendTo('#searchTable');

		} );

		</script>

			
			<div id="content">
			
				<div id="inner-content" class="wrap clearfix">
				
				    <div id="main" class="eightcol first clearfix" role="main">
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

					    	<?php 
							if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('<p id="breadcrumbs"><a href="' . home_url() . '">Home</a> &raquo; <a href="/learning-center">Learning Center</a> &raquo; ','</p>');
							} ?>

							
								<?php if (is_post_type_archive()) {
									echo '<h1 class="page-title">';
								 	post_type_archive_title(); 
								 	echo '</h1>';
								 } else {
								 	$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
								 	//print_r($the_tax);
									//echo $the_tax->singular_label;
									echo '<h1 class="page-title">';
									if (get_query_var( 'taxonomy' ) == 'audiences') {
										echo 'Resources for ';
										echo "<strong>" . single_tag_title("", false) . "</strong>";
									} elseif (get_query_var( 'taxonomy' ) == ('topics' || 'libraries') ) {
										echo "<strong>" . single_tag_title("", false) . "</strong>";
										echo ' Resources';
										echo $the_tax->description;
									} else {
										echo 'Resources tagged <strong>' . single_tag_title('', false) . '</strong>';
									}
									echo '</h1>';
									echo term_description();
								 }
								 ?>
							</h1>

						    <table id="pub_table" width="100%" class="pretty">

						    	<thead>
						    		<tr>
						    			<th class="resource_title">Resource</th>
						    			<th class="resource_libraries">Library</th>
						    			<th class="resource_audiences">Target Audience</th>
						    			<th class="resource_topics">Topic</th>
						    			<th class="resource_types">Type</th>
						    		</tr>
						    	</thead>

						    	<tbody>
					    		<?php if (have_posts()) {

										while (have_posts()) : the_post();
										if ( 'resources' == get_post_type() ) {
								        $libraries = get_the_term_list( $post->ID, 'libraries', '<span class="list">', '</span><span class="list">', '</span>');
								        $audiences = get_the_term_list( $post->ID, 'audiences', '<span class="list">', '</span><span class="list">', '</span>');
								        $topics = get_the_term_list( $post->ID, 'topics', '<span class="list">', '</span><span class="list">', '</span>');
								       // $types = get_the_term_list( $post->ID, 'types', '<span class="list">', '</span><span class="list">', '</span>');
								        $types = get_the_terms( $post->ID, 'types' );
						
									
						    		?>
						    		<tr>
						    			<td class="resourcetd"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></td>
						    			<td><?php // RESOURCE LIBRARIES
									        	echo $libraries;
								        ?></td>
								        <td><?php // RESOURCE AUDIENCES
									        echo $audiences;
								        ?></td>
								        <td><?php // RESOURCE TOPICS
									        echo $topics;
								        ?></td>
								        <td class="types"><?php // RESOURCE TYPES
									        //echo $types;
								        if ( $types && ! is_wp_error( $types ) ) : 

										$term_links = array();

										foreach ( $types as $type ) {

											if ( $type->slug == 'download' ) {
												$icon = '<span aria-hidden="true" data-icon="&#xf01a;" title="Downloadable materials available"></span>';
											} elseif ( $type->slug == 'article' ) {
												$icon = '<span aria-hidden="true" data-icon="&#xf0f6;" title="Read an article"></span>';
											} elseif ( $type->slug == 'webinar' ) {
												$icon = '<span aria-hidden="true" data-icon="&#xf06e;" title="Watch a webinar"></span>';
											} elseif ( $type->slug == 'video' ) {
												$icon = '<span aria-hidden="true" data-icon="&#xf03d;" title="Watch a video"></span>';
											} elseif ( $type->slug == 'book' ) {
												$icon = '<span aria-hidden="true" data-icon="&#xf02d;" title="Read a book"></span>';
											} elseif ( $type->slug == 'e-learning' ) {
												$icon = '<span aria-hidden="true" data-icon="&#xf044;" title="E-learning course"></span>';
											} else {
												$icon = '<span aria-hidden="true" data-icon="&#xf06e;" title="Read more on the web"></span>';
											}
											
											$term_links[] = $icon;
										}
															
										$show_terms = join( "", $term_links );
										//$show_terms = $term_links;
										echo $show_terms;
										endif;
								        ?></td>
						    		</tr>
						    		<?php }
						    		endwhile; ?>	
						    	</tbody>
						    	<tfoot>
						    		<tr>
						    			<th class="resource_title">Resource</th>
						    			<th class="resource_libraries">Library</th>
						    			<th class="resource_audiences">Target Audience</th>
						    			<th class="resource_topics">Topic</th>
						    			<th class="resource_types">Type</th>
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
    		    				    <p><?php _e("This is the error message in the resource-table template.", "bonestheme"); ?></p>
    			    			</footer>
    				    	</article>
					
					    <?php }  ?>
			
    				</div> <!-- end #main -->
    
	    			<div id="sidebar1" class="sidebar fourcol last clearfix" role="complementary">
	    				
	    				<p id="searchTable" class="clearfix"></p>

	    				<div class="filters clearfix">
			    			<h5>Filter Resources by:</h5>
			    				<h6>Library</h6>
			    				<div id="lib_container"></div>

			    				<h6>Target Audience</h6>
			    				<div id="aud_container"></div>

			    				<h6>Topic</h6>
			    				<div id="topic_container"></div>
			    		</div>

						<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

							<?php dynamic_sidebar( 'sidebar1' ); ?>

						<?php else : ?>
		
							

						<?php endif; ?>
	    			</div>
                
                </div> <!-- end #inner-content -->
                
			</div> <!-- end #content -->

<?php get_footer(); ?>